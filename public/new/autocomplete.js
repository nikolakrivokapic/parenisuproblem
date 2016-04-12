

var kpAutocomplete = Class.create({
	initialize: function(options) {
		this.options = options || {};
		
		this.holderEl = $(this.options['holderEl']);
		this.input = $(this.options['input']);
		this.searchTS = false;
		this.lastSearchText = false;
		
		this.categoryId = 0;
		this.groupId = 0;

		var _this = this;
		this.listSource = new kpAutocompleteSource({
			onSearchComplete: function() {
				_this.hideLoader();
				if (_this.listSource.size() > 0) {
					_this.list.displayList();
				} else {
					_this.hide();
					_this.list.displayList();
				}
			}
		});

		this.list = new kpAutocompleteList({
			holderEl: this.holderEl,
			'listSource': this.listSource,
			onItemClick: function(itemIndex) {
				_this.itemClicked(itemIndex);
			}
		});

		if (document.loaded)
			this.onDomLoaded();
		else
			document.observe('dom:loaded',this.onDomLoaded.bind(this));
	},
	onDomLoaded: function(event) {
		this.init();
	},
	init: function() {
		
		this.input.autocomplete = 'off';
		this.initObserves();
	},
	initObserves: function() {
		var _this = this;
		this.input.observe('keydown',function(evt) {
			_this.processKeyUp(evt);
		});
		this.holderEl.observe('keydown',function(evt) {
			_this.processKeyUp(evt);
		});
		this.input.observe('keypress',function(evt) {
			_this.processKeyUp(evt);
		});
		this.holderEl.observe('keypress',function(evt) {
			_this.processKeyUp(evt);
		});

		document.observe('click',function(evt) {
			if (_this.holderEl.visible()) {
				if (Event.findElement(evt,'#'+_this.holderEl.id) == undefined) {
					_this.hide();
				}
			}
		});

	},
	setCategoryId: function(categoryId) {
		this.categoryId = categoryId || 0;
	},
	setGroupId: function(groupId) {
		this.groupId = groupId || 0;
	},
	processKeyUp: function(evt) {
		if (evt.keyCode == Event.KEY_RETURN) {
			var itemIndex = this.list.getSelectedItemIndex();
			if (itemIndex != undefined) {
				Event.stop(evt);
				this.itemClicked(itemIndex);
			}
		} else if (evt.keyCode == Event.KEY_UP) {
			this.list.selectPrev()
		} else if (evt.keyCode == Event.KEY_DOWN) {
			this.list.selectNext()
		} else {
			this.afterKeyUp.bind(this).delay(0.5);
		}
	},
	afterKeyUp: function() {
		if (this.input.value > '') {
			this.show();
			var _this = this;
			if (this.searchTS)
				clearTimeout(this.searchTS);
			this.searchTS =  (function() {
				_this.search(_this.input.value);
			}).delay(0.6);
		}
	},
	show: function() {
		this.holderEl.show();
	},
	hide: function() {
		this.holderEl.hide();
	},
	search: function(text) {
		var _this = this;
		if (this.lastSearchText != text) {
			this.showLoader();
			this.lastSearchText = text;
			_this.listSource.search(text,{category_id: this.categoryId, group_id: this.groupId});
		}
	},
	itemClicked: function(itemIndex) {
		var memo = {};
		var item = this.listSource.getItemByIndex(itemIndex);
		if (item && item['params']) memo = item['params'];
		var _this = this;
		
		if (memo['type'] == 'ad' && memo['ad_url'] > '') {
			location = memo['ad_url'];
		} else if (memo['type'] != 'text') {
			this.input.value = '';
			if (memo['text'] != undefined && memo['text'] > '')
				this.input.value = memo['text'];
			document.fire('kpAC:change',memo);
			if (memo['type'] != 'car_make' && memo['type'] != 'car_model') {
				(function() {
					_this.input.form.submit();
				}).delay(0.5);
			} else {
				$('searchFormHolder').addClassName('form-opened'); $('searchFormHolder').removeClassName('form-closed'); // ZAMENITI BOLJIM KODOM
			}
		} else if (memo['type'] == 'text' && memo['text'] > '') {
			this.input.value = memo['text'];
			this.input.form.submit();
		}
		
		this.hide();
	},
	showLoader: function() {
		this.holderEl.select('[action-name=loader]').each(function(el) {
			el.show();
		});
	},
	hideLoader: function() {
		this.holderEl.select('[action-name=loader]').each(function(el) {
			el.hide();
		});
	}
});

var kpAutocompleteSource = Class.create({
	initialize: function(options) {
		this.options = options || {};
		
		this.list = $A([]);
		
		this.onSearchComplete = this.options['onSearchComplete'] || false;
		
		this.searchAjaxIndex = 0;
	},
	size: function() {
		return this.list.size();
	},
	each: function(f) {
		this.list.each(f);
	},
	getItemByIndex: function(ind) {
		return this.list[ind];
	},
	search: function(text,params) {
		var params = params || {};
		var url = 'autocomplete.php';
		var ajaxParams = {
			'text': text,
			'category_id': params['category_id'] || 0,
			'group_id': params['group_id'] || 0
		};
		var _this = this;
		this.searchAjaxIndex++;
		var localSearchAjaxIndex = this.searchAjaxIndex;
		new Ajax.Request(url, {
			asynchronous: true,
			parameters: ajaxParams,
			onComplete:function(req) {
				if (localSearchAjaxIndex != _this.searchAjaxIndex) return;
				if (req.readyState == 4) {
					if (req.status == 200) {
						var json = req.responseText.evalJSON(true);

						_this.originalValues = json;
						_this.list = $A([]);
						json.each(function(el) {
							if (el['name'] != undefined) {
								_this.list.push({'name': el['name'], 'params': el['params']});
							}
						});

						if (_this.onSearchComplete) {
							_this.onSearchComplete();
						}						
					}
				}
			}
		});
	}
});

var kpAutocompleteList = Class.create({
	initialize: function(options) {
		this.options = options || {};
		
		this.holderEl = $(this.options['holderEl']);
		this.listHolderEl = this.holderEl.select('[action-name=list-holder]')[0];
		this.listSource = this.options['listSource'];
		
		this.onItemClick = this.options['onItemClick'] || false;

		if (document.loaded)
			this.onDomLoaded();
		else
			document.observe('dom:loaded',this.onDomLoaded.bind(this));
	},
	onDomLoaded: function(event) {
		this.init();
	},
	init: function() {
	},
	addItem: function(name, params, options) {
		var options = options || {};
		if (params.isString()) {
			try {
				params = params.evalJSON(true);
			} catch(e) {
				params = {};
			}
		}
		this.list.push({
			'name': name, 'params': params
		});
		
		if (!options['skipDisplayList']) {
			this.removeItems();
			this.displayList();
		}
	},
	addItems: function(items) {
		try {
			var _this = this;
			items.each(function(el) {
				if (el['name'] > '') {
					_this.addItem(el['name'], el['params'],{skipDisplayList: true});
				}
			});
		} catch(e) {}
		this.removeItems();
		this.displayList();
	},
	removeItems: function() {
		this.list = $A([]);
	},
	displayList: function() {
		var _this = this;
		this.removeItemsHtml();
		this.listSource.each(function(el,ind) {
			_this.addItemHtml(el,ind);
		});
	},
	addItemHtml: function(item,ind) {
		var _this = this;
		var tmpLi = new Element('li',{'list-index': ind});
		var tmpLabel = new Element('span',{className: 'kpACListItemLabel','action-name': 'label','list-index': ind}).update(item['name']);
		tmpLi.insert({top: tmpLabel});
		
		this.listHolderEl.insert({bottom: tmpLi});
		
		tmpLi.observe('click',function(evt) {
			_this.itemClicked(ind);
		});

		tmpLi.observe('mouseover',function(evt) {
			_this.setSelectedItem(ind);
		});
		
		//this.list[ind]['itemEl'] = tmpLi;
	},
	removeItemsHtml: function() {
		this.listHolderEl.update('');
		return;
		
		this.listSource.each(function(el,ind) {
			try {
				if (el['itemEl']) {
					el['itemEl'].remove();
				}
			} catch(e) {}
		});
	},
	itemClicked: function(itemIndex) {
		this.onItemClick(itemIndex);
	},
	setSelectedItem: function(itemIndex) {
		this.listHolderEl.select('li[list-index]').each(function(el) {
			var ind = el.readAttribute('list-index');
			if (ind && ind > '') {
				if (ind == itemIndex) {
					el.addClassName('selected');
				}	else {
					el.removeClassName('selected');
				}
			}
		})
	},
	selectNext: function() {
		var curIndex = this.getSelectedItemIndex();
		var newIndex;
		if (curIndex == undefined) {
			newIndex = 0;
		}
		else {
			newIndex = (parseInt(curIndex) + 1) % this.listSource.size();
		}
		this.setSelectedItem(newIndex);
	},
	selectPrev: function() {
		var curIndex = this.getSelectedItemIndex();
		var newIndex;
		if (curIndex == undefined) {
			newIndex = 0;
		}
		else {
			newIndex = (parseInt(curIndex) - 1) % this.listSource.size();
		}
		if (newIndex < 0) newIndex += this.listSource.size();
		this.setSelectedItem(newIndex);
	},
	getSelectedItemIndex: function() {
		var sel = this.listHolderEl.select('li.selected[list-index]');
		if (sel && sel[0]) {
			return sel[0].readAttribute('list-index');
		}
		return undefined;
	}
});


var kpFormSelectField = Class.create({
	initialize : function(options) {
		this.options = options || {};
		
		this.values = $H({});
		this.observs = $H({});

		var _this = this;
		
		this.fieldDisplay = this.options['fieldDisplay'] || null;
		this.fieldSecondDisplay = this.options['fieldSecondDisplay'] || null;
		
		this.fieldValuesSelection = this.options['fieldValuesSelection'] || null;
		this.fieldValuesSource = this.options['fieldValuesSource'] || null;
		this.fieldValueStorage = this.options['fieldValueStorage'] || null;
		
		if (this.fieldValuesSelection) {
			this.fieldValuesSelection.valuesSource = this.fieldValuesSource;
			if (this.fieldSecondDisplay && this.fieldSecondDisplay.menuEl) {
				this.fieldValuesSelection.holderEl = this.fieldSecondDisplay.menuEl;
			} else {
				this.fieldValuesSelection.holderEl = this.fieldDisplay.menuEl;
			}
			this.fieldValuesSelection.initOnDocumentLoaded();
		}
		
		this.multiselect = this.options['multiselect'] || false;
		
		this.valuesSelectionDisplayHolder = null;
		
		this.getInitialStorageValue();
		
		this.initObservers();
	},
	initObservers: function() {
		var _this = this;

		if (this.fieldDisplay) {
			this.fieldDisplay.observe('choice:remove',function(evt) {
				if (evt && evt['memo'] && evt['memo']['key']) {
					_this.removeValue(evt['memo']['key'],{source: evt['memo']['source'] || 'user',fieldDisplay: _this.fieldDisplay});
				}
			});
			this.fieldDisplay.observe('opened',function(evt) {
				if (_this.fieldValuesSelection && _this.fieldValuesSelection.setHolder) {
					if (_this.fieldValuesSelection.getHolder() != _this.fieldDisplay.menuEl) {
						_this.fieldValuesSelection.setHolder(_this.fieldDisplay.menuEl);
					}
					_this.valuesSelectionDisplayHolder = _this.fieldDisplay;
					if (_this.fieldValuesSelection && _this.fieldValuesSelection.show) {
						_this.fieldValuesSelection.show();
					}
				}
			});
			this.fieldDisplay.observe('closed',function(evt) {
				if (_this.fieldValuesSelection && _this.fieldValuesSelection.hide) {
					_this.fieldValuesSelection.hide();
				}
			});
		}
		if (this.fieldSecondDisplay) {
			this.fieldSecondDisplay.observe('choice:remove',function(evt) {
				if (evt && evt['memo'] && evt['memo']['key']) {
					_this.removeValue(evt['memo']['key'],{source: evt['memo']['source'] || 'user',fieldDisplay: _this.fieldSecondDisplay});
				}
			});
			this.fieldSecondDisplay.observe('opened',function(evt) {
				if (_this.fieldValuesSelection && _this.fieldValuesSelection.setHolder) {
					if (_this.fieldValuesSelection.getHolder() != _this.fieldSecondDisplay.menuEl) {
						_this.fieldValuesSelection.setHolder(_this.fieldSecondDisplay.menuEl);
					}
					_this.valuesSelectionDisplayHolder = _this.fieldSecondDisplay;
					if (_this.fieldValuesSelection && _this.fieldValuesSelection.show) {
						_this.fieldValuesSelection.show();
					}
				}
			});
			this.fieldSecondDisplay.observe('closed',function(evt) {
				if (_this.fieldValuesSelection && _this.fieldValuesSelection.hide) {
					_this.fieldValuesSelection.hide();
				}
			});
		}

		if (this.fieldValuesSelection) {
			this.fieldValuesSelection.observe('choice:click',function(evt) {
				if (evt && evt['memo'] && evt['memo']['key']) {
					_this.addValue(evt['memo']['key'], evt['memo']['value'] || undefined, {source: evt['memo']['source'],fieldDisplay: _this.valuesSelectionDisplayHolder});
				}
			});
			this.fieldValuesSelection.observe('close',function(evt) {
				_this.fieldDisplay.close();
				_this.fieldSecondDisplay.close();
			});
		}

		if (this.fieldValuesSource && this.fieldValuesSource.observe) {
			this.fieldValuesSource.observe('values:loading',function(evt) {
				if (_this.fieldDisplay && _this.fieldDisplay.loading) {
					_this.fieldDisplay.loading();
				}
				if (_this.fieldSecondDisplay && _this.fieldSecondDisplay.loading) {
					_this.fieldSecondDisplay.loading();
				}
			});
			
			this.fieldValuesSource.observe('values:loaded',function(evt) {
				if (_this.fieldDisplay && _this.fieldDisplay.notLoading) {
					_this.fieldDisplay.notLoading();
				}
				if (_this.fieldSecondDisplay && _this.fieldSecondDisplay.notLoading) {
					_this.fieldSecondDisplay.notLoading();
				}
				
				// remove non existing values
				_this.values.each(function(el) {
					var vv = _this.fieldValuesSource.getValue(el['key'],{skipInitialValues: true});
					if (!vv) {
						_this.removeValue(el['key']);
					} else {
						_this.lateValueUpdate(el['key'], vv);
					}
				});
				// end remove non existing values
				_this.updateFieldDisplayValues();
				_this.updateFieldValuesSelection();
			});
		}
		
		if (this.options['autocompleteEventKeyParam']) {
			document.observe('kpAC:change',function(evt) {
				if (evt.memo && evt.memo[_this.options['autocompleteEventKeyParam']]) {
					var value = evt.memo[_this.options['autocompleteEventValueParam']] || undefined;
					_this.addAutocompleteValue(evt.memo[_this.options['autocompleteEventKeyParam']], value);
				}
			});
		}		
	},
	getInitialStorageValue: function() {
		var _this = this;
		if (this.fieldValueStorage && this.fieldValueStorage.get) {
			var currentValue = this.fieldValueStorage.get();
			if (currentValue && currentValue > '') {
				var keys = $A(currentValue.split(','));
				if (keys && keys.size() > 0) {
					keys.each(function(el) {
						_this.addInitialValue(el);
					})
				}
			}
		}		
	},
	addInitialValue: function(key, value) {
		var value = value || undefined;
		this.addValue(key, value);
	},
	lateValueUpdate: function(key, value) { // When source has loaded values
		this.values.set(key, value);
	},
	addValue: function(key, value, params) {
		var params = params || {};
		var value = value || undefined; // Add dynamic fetch of value by key
		
		if (this.options['beforeAddChoice']) {
			if (this.options['beforeAddChoice'](key, value, params)) { // On true, stop
				return;
			}
		}
		
		if (value === undefined) {
			if (this.fieldValuesSource && this.fieldValuesSource.getValue) {
				value = this.fieldValuesSource.getValue(key);
			}
		}
		this._addValue(key, value, params);
	},
	_addValue: function(key, value, params) {
		var params = params || {};
		var value = value || undefined; // Add dynamic fetch of value by key
		
		if (this.multiselect) {
			var currVal = this.values.get(key);
			if (!currVal || (currVal !== value && value !== undefined)) {
				this.values.set(key,value);
				this.fieldDisplay.close();
				if (this.fieldSecondDisplay && this.fieldSecondDisplay.close) {
					this.fieldSecondDisplay.close();				
				}
				this.fire('changed',{
					source: params['source'],
					fieldDisplay: this.valuesSelectionDisplayHolder, 
					fieldDisplayNum: this.fieldSecondDisplay && this.valuesSelectionDisplayHolder == this.fieldSecondDisplay ? 2 : 1});
			}
		} else {
			var currVal = this.values.get(key);
			if (!currVal || (currVal !== value && value !== undefined)) {
				this.values = $H({});
				this.values.set(key,value);
				this.fieldDisplay.close();
				if (this.fieldSecondDisplay && this.fieldSecondDisplay.close) {
					this.fieldSecondDisplay.close();
				}
				this.fire('changed',{
					source: params['source'], 
					fieldDisplay: this.valuesSelectionDisplayHolder, 
					fieldDisplayNum: this.fieldSecondDisplay && this.valuesSelectionDisplayHolder == this.fieldSecondDisplay ? 2 : 1});
			}
		}
		
		this.updateFieldDisplayValues();
		this.updateFieldValueStorage();
	},
	addAutocompleteValue: function(key, value) {
		this.addValue(key, value);
	},
	getValue: function() {
		var v = this.values.values();
		if (v && v.size() > 0) {
			return v.join(',');
		} else {
			return '';
		}
	},
	getKey: function() {
		var v = this.values.keys();
		if (v && v.size() > 0) {
			return v.join(',');
		} else {
			return '';
		}
	},
	getKeys: function() {
		return this.values.keys();
	},
	getValues: function() {
		return this.values.values();
	},
	removeValue: function(key, params) {
		var params = params || {};
		
		if (this.options['beforeRemoveChoice']) {
			if (this.options['beforeRemoveChoice'](key)) return; // Stop if true
		}
		
		this.values.unset(key);
		this.fire('changed',{source: params['source']});
		this.updateFieldDisplayValues();
		this.updateFieldValueStorage();
	},
	removeAllValues: function() {
		if (this.values.size() > 0) {
			this.values = $H({});
			this.fire('changed');
			this.updateFieldDisplayValues();
			this.updateFieldValueStorage();
		}
	},
	remove: function() {
		if (this.fieldDisplay) this.fieldDisplay.remove();
		if (this.fieldSecondDisplay) this.fieldSecondDisplay.remove();
	},
	updateFieldDisplayValues: function() {
		this.fieldDisplay.removeChoices();
		this.fieldDisplay.addChoices(this.values);
		if (this.fieldSecondDisplay) {
			this.fieldSecondDisplay.removeChoices();
			this.fieldSecondDisplay.addChoices(this.values);
		}
	},
	updateFieldValuesSelection: function() {
		this.fieldValuesSelection.initElements();
		this.fieldValuesSelection.initRecentLinks();
	},
	updateFieldValueStorage: function() {
		if (this.fieldValueStorage && this.fieldValueStorage.set) {
			this.fieldValueStorage.set('');
			this.fieldValueStorage.set(this.getKeys().join(','));
		}
	},
	open: function() {
		this.fieldDisplay.open();
	},
	close: function() {
		this.fieldDisplay.close();
		if (this.fieldSecondDisplay && this.fieldSecondDisplay.close) {
			this.fieldSecondDisplay.close();
		}
	},
	hide: function() {
		if (this.fieldDisplay) this.fieldDisplay.hide();
		if (this.fieldSecondDisplay) this.fieldSecondDisplay.hide();
	},
	show: function() {
		if (this.fieldDisplay) this.fieldDisplay.show();
		if (this.fieldSecondDisplay) this.fieldSecondDisplay.show();
	},
	observe: function(eventName, func) {
		var o = this.observs.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observs.set(eventName, o);
	},
	fire: function(eventName, params) {
		var params = params || {};
		var evt = {};
		//var evt = new Event(eventName);
		evt['memo'] = params;
		var o = this.observs.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				o[i].defer(evt);
			}
		}
	}
});

/* Value of key is not always available immediately, so source update might be needed and value fetched asynchonously */
var kpFormSelectFieldAjaxSource = Class.create(kpFormSelectField, {
	addValue: function(key, value, params) {
		var value = value || undefined; // Add dynamic fetch of value by key
		var _this = this;
		
		if (this.options['beforeAddChoice']) {
			if (this.options['beforeAddChoice'](key, value, params)) { // On true, stop
				return;
			}
		}
				
		if (value === undefined) {
			if (!this.fieldValuesSource.loadingValues) {
				value = this.fieldValuesSource.getValue(key, {
					onValueLoad: function(val) {
						_this._addValue(key, val, params);
					}
				});
			} else {
				this.fieldValuesSource.observeOnce('values:loaded', function(evt) {
					_this.addValue(key, value, params);
				});
			}
		}

		if (value !== undefined) {
			this._addValue(key, value, params);
		}
	},
	getInitialStorageValue: function($super) {
		$super();
	},
	addInitialValue: function($super, key, value) {
		var value = value || undefined;
		if (value == undefined) {
			value = this.fieldValuesSource.getValue(key);
		}
		this._addValue(key, value || ' ');
	},
	addAutocompleteValue: function($super, key, value) {
		var value = value || undefined;
		if (value == undefined) {
			value = this.fieldValuesSource.getValue(key);
		}
		this._addValue(key, value);
	}
});

var kpFormSelectFieldHashSource = Class.create(kpFormSelectField, {
	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;

		this.fieldValuesSource = new kpChoiceValuesSourceHash({
			'values': this.options['values'] || {}
		});

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: this.options['holderEl'],
			multiselect: this.options['multiselect'] || false,
			defaultLabel: this.options['defaultLabel'],
			notEmptyLabel: this.options['notEmptyLabel'],
			defaultKey: this.options['defaultKey'] || false,
			defaultValue: this.options['defaultValue'] || false,
			emptySelectionDisabled: this.options['emptySelectionDisabled']
		});

		if (this.options['secondHolderEl'] && $(this.options['secondHolderEl'])) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: this.options['secondHolderEl'],
				multiselect: this.options['multiselect'] || false,
				hideWhenEmpty: this.options['secondDisplayHideWhenEmpty'] == undefined ? true : this.options['secondDisplayHideWhenEmpty'],
				defaultLabel: this.options['defaultLabel'],
				notEmptyLabel: this.options['notEmptyLabel'],
				defaultKey: this.options['defaultKey'] || false,
				defaultValue: this.options['defaultValue'] || false,
				emptySelectionDisabled: this.options['emptySelectionDisabled']
			});
		}

		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: this.options['enableKeywordSearch'],
			columns: this.options['columns']
		});
		
		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: this.options['storageInputId']
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: this.options['multiselect'] || false,
			recentValuesMaxCount: this.options['recentValuesMaxCount'] || 3,
			recentValues: this.options['recentValues'] || []			
		});
	}
});

var kpFormSelectFieldArraySource = Class.create(kpFormSelectField, {
	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;

		this.fieldValuesSource = new kpChoiceValuesSourceArray({
			'values': this.options['values'] || []
		});

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: this.options['holderEl'],
			multiselect: this.options['multiselect'] || false,
			defaultLabel: this.options['defaultLabel'],
			notEmptyLabel: this.options['notEmptyLabel'],
			defaultKey: this.options['defaultKey'],
			defaultValue: this.options['defaultValue'],
			emptySelectionDisabled: this.options['emptySelectionDisabled']
		});
		
		if (this.options['secondHolderEl'] && $(this.options['secondHolderEl'])) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: this.options['secondHolderEl'],
				multiselect: this.options['multiselect'] || false,
				hideWhenEmpty: this.options['secondHideWhenEmpty'] !== undefined ? this.options['secondHideWhenEmpty'] : true,
				defaultLabel: this.options['defaultLabel'],
				notEmptyLabel: this.options['notEmptyLabel'],
				defaultKey: this.options['defaultKey'] || false,
				defaultValue: this.options['defaultValue'] || false,
				emptySelectionDisabled: this.options['emptySelectionDisabled']
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: this.options['enableKeywordSearch'],
			columns: this.options['columns']
		});
		
		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: this.options['storageInputId']
		});

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: this.options['multiselect'] || false,
			recentValuesMaxCount: this.options['recentValuesMaxCount'] || 3,
			recentValues: this.options['recentValues'] || [],
			autocompleteEventKeyParam: this.options['autocompleteEventKeyParam']
		});

	}
});

var kpFormRangeSelectField = Class.create({
	initialize : function(options) {
		this.options = options || {};
		var _this = this;

		this.minField = new kpFormSelectFieldHashSource({
			values: this.options['values'],
			holderEl: this.options['minHolderEl'],
			secondHolderEl: this.options['secondMinHolderEl'],
			multiselect: this.options['multiselect'] || false,
			defaultLabel: this.options['minDefaultLabel'],
			notEmptyLabel: this.options['minNotEmptyLabel'],
			columns: this.options['columns'] || 1,
			storageInputId: this.options['minStorageInputId'],
			secondDisplayHideWhenEmpty: this.options['secondDisplayHideWhenEmpty'],
			enableKeywordSearch: this.options['enableKeywordSearch'],
		});
		this.minField.fieldDisplay.joinNext();

		this.maxField = new kpFormSelectFieldHashSource({
			values: this.options['values'],
			holderEl: this.options['maxHolderEl'],
			secondHolderEl: this.options['secondMaxHolderEl'],
			multiselect: this.options['multiselect'] || false,
			defaultLabel: this.options['maxDefaultLabel'],
			notEmptyLabel: this.options['maxNotEmptyLabel'],
			columns: this.options['columns'] || 1,
			storageInputId: this.options['maxStorageInputId'],
			secondDisplayHideWhenEmpty: this.options['secondDisplayHideWhenEmpty'],
			enableKeywordSearch: this.options['enableKeywordSearch'],
		});
		this.maxField.fieldDisplay.joinPrev();
		
		this.minField.observe('changed',function(evt) {
			_this.updateSecondDisplay();
		});
		this.maxField.observe('changed',function(evt) {
			_this.updateSecondDisplay();
		});

		this.updateSecondDisplay();
				
	},
	updateSecondDisplay: function() {
		var minValue = this.minField.getValue();
		var maxValue = this.maxField.getValue();
		
		if ((minValue && maxValue) || this.options['secondDisplayHideWhenEmpty'] === false) {
			this.maxField.fieldSecondDisplay.joinPrev();
			this.minField.fieldSecondDisplay.joinNext();
			this.maxField.fieldSecondDisplay.show();
			this.minField.fieldSecondDisplay.show();
		} else if (maxValue) {
			this.maxField.fieldSecondDisplay.unjoinPrev();
			this.maxField.fieldSecondDisplay.show();
			this.minField.fieldSecondDisplay.hide();
		} else if (minValue) {
			this.minField.fieldSecondDisplay.unjoinNext();
			this.minField.fieldSecondDisplay.show();
			this.maxField.fieldSecondDisplay.hide();			
		} else {
			this.maxField.fieldSecondDisplay.unjoinPrev();
			this.minField.fieldSecondDisplay.unjoinNext();
			this.maxField.fieldSecondDisplay.hide();
			this.minField.fieldSecondDisplay.hide();
		}
		
		return;
		
		var text = '';
		if (minValue && maxValue) {
			text = 'od '+minValue+' do '+maxValue;
		} else if (minValue) {
			text = 'od '+minValue;
		} else if (maxValue) {
			text = 'do '+maxValue;
		}

		this.secondDisplay.removeChoices();
		if (text > '') {
			this.secondDisplay.addChoices({'1': text});
		}
	}
});

function createFormChoicesDisplay(params) {
	var params = params || {};
	var templateEl = params['templateEl'] ? $(params['templateEl']) : $('choiceListDisplayTemplate');

	var tmpEl = templateEl.clone(true);
	tmpEl.id = params['holderId'] || '';

	// Insert
	var insertParams = {};
	var insertPosition = params['insertPosition'] || 'bottom';
	var insertEl = params['insertEl'] ? $(params['insertEl']) : false;
	
	if (params['skipOddEvenCount']) tmpEl.writeAttribute('skip-odd-even-count','yes');

	if (insertEl !== false) {
		insertParams[insertPosition] = tmpEl;
		insertEl.insert(insertParams);
		if (!params['keepHidden']) {
			tmpEl.show();
		}
	}
	
	//document.fire('choiceDisplay:changed');

	return tmpEl;
}

var kpFormChoicesDisplay = Class.create({

	initialize : function(options) {
		this.options = options || {};
		
		this.fieldObj = this.options['fieldObj'];
		this.holderEl = $(this.options['holderEl']);
		this.contentEl = this.holderEl.select('[action-name=content]')[0];
		try {
			this.choiceFirstOptionTpl = this.holderEl.select('[action-name=choice-first-option-template]')[0];
		} catch(e) {
			this.choiceFirstOptionTpl = null;
		}
		this.choiceOptionTpl = this.holderEl.select('[action-name=choice-option-template]')[0];
		this.menuEl = this.holderEl.select('[action-name=menu-holder]')[0];
		this.labelEl = this.holderEl.select('[action-name=label]')[0];
		
		this.defaultLabel = this.options['defaultLabel'] || (this.labelEl ? this.labelEl.innerHTML : false);
		this.notEmptyLabel = this.options['notEmptyLabel'];
		
		this.multiselect = true;
		if (this.options['multiselect'] !== undefined) 
			this.multiselect = this.options['multiselect'];
		
		if (this.holderEl && this.multiselect) {
			this.holderEl.addClassName('multiselect');
		}
		
		this.defaultKey = this.options['defaultKey'] || false;
		this.defaultValue = this.options['defaultValue'] || undefined;
		this.emptySelectionDisabled = this.options['emptySelectionDisabled'] || false;
		this.hideWhenEmpty = this.options['hideWhenEmpty'] || false;
		
		this.onOpen = this.options['onOpen'] || false;
		
		this.choices = $H({});
		this.choicesHtml = $H({});
		this.choiceSelector = false;
		
		this.observs = $H({});

		this.assignDefaultIfEmpty();
		this.initObservers();
		this.updateEmptyClass();
		this.updateLabel();
		
		//document.fire('choiceDisplay:changed');
	},
	initObservers: function() {
		var _this = this;
		this.contentEl.observe('click',function(evt) {
			if (Event.findElement(evt,'a[action-name=close]') == undefined && Event.findElement(evt,'[action-name=menu-holder]') == undefined) {
				_this.toggle();
				// broadcast event to field object
			}
		});
		this.contentEl.observe('choice:click',function(evt) {
			Event.stop(evt);
			(function() {
				_this.toggle();
				// broadcast event to field object
				
			}).delay(0.1);
		});
		if (this.menuEl) {
			this.menuEl.select('[action-name=choice-menu-close]').each(function(el) {
				el.observe('click',function(evt) {
					_this.close();
					// broadcast event to field object
				});
			});
		}
		document.observe('click',function(evt) {
			if (_this.isOpened()) {
				if (Event.findElement(evt,'#'+_this.holderEl.id) == undefined && Event.findElement(evt,'[parent-id='+_this.holderEl.id+']') == undefined) {
					_this.close();
				}
			}
		});
	},
	isOpened: function() {
		return this.holderEl.hasClassName('opened');
	},
	open: function() {
		this.holderEl.addClassName('opened');
		this.fire('opened');
		//this.updateSelectorShowHide();
		this.updateMenuAlighment();
	},
	close: function() {
		this.holderEl.removeClassName('opened');
		this.fire('closed');
		//this.updateSelectorShowHide();
	},
	toggle: function() {
		if (this.isOpened()) {
			this.close();
		} else {
			this.open();
		}
		//this.updateSelectorShowHide();
	},
	remove: function() {
		this.holderEl.remove();
		//document.fire('choiceDisplay:changed');
	},
	show: function() {
		this.holderEl.show();
		//document.fire('choiceDisplay:changed');
	},
	hide: function() {
		this.holderEl.hide();
		//document.fire('choiceDisplay:changed');
	},
	joinNext: function() {
		this.holderEl.addClassName('joinNext');
	},
	joinPrev: function() {
		this.holderEl.addClassName('joinPrev');
	},
	unjoinNext: function() {
		this.holderEl.removeClassName('joinNext');
	},
	unjoinPrev: function() {
		this.holderEl.removeClassName('joinPrev');
	},
	loading: function() {
		this.holderEl.addClassName('choiceLoading');
	},
	notLoading: function() {
		this.holderEl.removeClassName('choiceLoading');
	},
	clearfix: function() {
		this.holderEl.addClassName('clearboth');
	},
	addClassName: function(className) {
		this.holderEl.addClassName(className);
	},
	removeClassName: function(className) {
		this.holderEl.removeClassName(className);
	},
	updateSelectorShowHide: function() {
		if (this.isOpened()) {
			if (this.choiceSelector && this.choiceSelector.show)
				this.choiceSelector.show();
		} else {
			if (this.choiceSelector && this.choiceSelector.hide)
				this.choiceSelector.hide();
		}
	},
	updateMenuAlighment: function() {
		try {
			var parentEl = this.holderEl.getOffsetParent();
			var parentDim = parentEl.getDimensions();
			var offset = this.holderEl.positionedOffset().toArray();
			if (offset[0] > parentDim['width'] / 2) {
				this.holderEl.addClassName('right');
			} else {
				this.holderEl.removeClassName('right');
			}
		} catch(e) {
			this.holderEl.removeClassName('right');
		}
	},
	getLabel: function() {
		if (this.labelEl && this.labelEl.innerHTML != undefined)
			return this.labelEl.innerHTML;
	},
	setLabel: function(label) {
		if (this.labelEl && this.labelEl.innerHTML != undefined) {
			if (label === false) {
				this.hideLabel();
			}
			else {
				this.showLabel();
				this.labelEl.update(label);
			}
		}
	},
	setDefaultLabel: function(defaultLabel) {
		this.defaultLabel = defaultLabel;
		this.updateLabel();
	},
	updateLabel: function() {
		if (this.choices.size() == 0) {
			this.setLabel(this.defaultLabel);
		} else {
			if (this.notEmptyLabel != undefined) {
				this.setLabel(this.notEmptyLabel);
			}
		}
	},
	hideLabel: function() {
		this.holderEl.addClassName('hideLabel');
	},
	showLabel: function() {
		this.holderEl.removeClassName('hideLabel');
	},
	doOnChange: function(params) {
		var params = params || {};
		this.updateEmptyClass();
		this.updateLabel();

		this.fire('change', params);
	},
	addChoice: function(key, value, params) {
		var params = params || {};

		if (this.multiselect) {
			this.removeHtmlChoices();
			var currVal = this.choices.get(key);
			if (!currVal || currVal !== value) {
				this.choices.set(key,value);
				this.addHtmlChoices();
			}
		} else {
			var currVal = this.choices.get(key);
			if (!currVal || currVal !== value) {
				this.removeHtmlChoices();
				this.choices = $H({});
				this.choices.set(key,value);
				this.addHtmlChoice(key, value);
				if (!params['skipClose'])
					this.close();
			}
		}
		
		this.assignDefaultIfEmpty();
		
		/*this.doOnChange({
			changeByUser: (params['source'] != undefined && params['source'] == 'user')
		});*/
	},
	toggleChoice: function(key, value, params) {
		if (this.choices.get(key) && this.multiselect) {
			this.removeChoice(key, params);
		} else {
			this.addChoice(key, value, params);
		}
		
		this.assignDefaultIfEmpty();
	},
	addChoices: function(values) {
		this.choices.update(values);
		this.showChoices();
		
		this.assignDefaultIfEmpty();

		this.doOnChange();
	},
	removeChoice: function(key, params) {
		var params = params || {};
		this.choices.unset(key);
		this.showChoices();
		
		this.assignDefaultIfEmpty();

		this.doOnChange();
	},
	removeChoices: function(params) {
		var params = params || {};
		this.choices = $H({});
		this.showChoices();

		this.doOnChange({
			changeByUser: (params['source'] != undefined && params['source'] == 'user')
		});
	},
	assignDefaultIfEmpty: function() {
		if (this.choices.size() == 0 && this.emptySelectionDisabled && this.defaultKey) {
			if (this.defaultValue && this.defaultValue > '') {
				this.addChoice(this.defaultKey, this.defaultValue);
			} else {
				this.addChoice(this.defaultKey);
			}
		}
	},
	getKeys: function() {
		return this.choices.keys();
	},
	getValues: function() {
		return this.choices.values();
	},
	showChoices: function() {
		this.removeHtmlChoices();
		this.addHtmlChoices();
	},
	addHtmlChoices: function() {
		var _this = this;
		var lastChoiceEl = null;
		this.choices.each(function(el) {
			lastChoiceEl = _this.addHtmlChoice(el.key,el.value);
		});
		if (lastChoiceEl) {
			lastChoiceEl.addClassName('last');
		}
	},
	addHtmlChoice: function(key,value) {
		var tmpEl;
		
		var first = this.choicesHtml.size() == 0;
		
		tmpEl = this.createHtmlChoice(key,value,first);
		
		//tmpEl.addClassName('first')
		//this.holderEl.addClassName('last');
		this.insertHtmlChoice(tmpEl, first);
		this.choicesHtml.set(key, tmpEl);			
		return tmpEl;
	
		/*if (this.choicesHtml.size() == 0) {
			tmpEl.addClassName('first');
			this.insertHtmlChoice(tmpEl);
			//this.holderEl.addClassName('last');
			this.choicesHtml.set(key, tmpEl);			
			return tmpEl;

		} else {
			if (this.choicesHtml.size() == 1) {
				liTmp.addClassName('last');
			}
			this.holderEl.insert({
				after: liTmp
			});
			this.holderEl.removeClassName('last');

			this.choicesHtml.set(key, liTmp);

			divTmp.observe('click',function(evt) {
				if (Event.findElement(evt,'a.choiceOptionClose') == undefined) {
					_this.contentEl.fire('choice:click');
				}
			});

			return liTmp;
		}*/

	},
	createHtmlChoice: function(key,value,first) {
		var tmpEl = null;
		var closeEl;
		var _this = this;
		var first = first || false;
		
		if (first && this.choiceFirstOptionTpl) {
			tmpEl = this.choiceFirstOptionTpl.clone(true);
		}
		if (!tmpEl) {
			tmpEl = this.choiceOptionTpl.clone(true);
		}
		tmpEl.writeAttribute('action-name','choice');
		tmpEl.writeAttribute('action-value',key);
		tmpEl.writeAttribute('title',value);
		tmpEl.writeAttribute('parent-id',this.holderEl.id);
		//tmpEl.addClassName('limitWidth');
		try {
			tmpEl.select('[action-name=choice-option-value]').each(function(el) {
				el.innerHTML = value;
			});
		} catch(e) {}
		if (!this.emptySelectionDisabled || (this.defaultKey && this.defaultKey != key)) {
			tmpEl.select('[action-name=close]').each(function(el) {
				el.observe('click',function(evt) {
					_this.fire('choice:remove',{'key': key});
				});
			});
		}
		return tmpEl;

		var liTmp = new Element('li',{'class': 'choice option','parent-id': this.holderEl.id});
		var divTmp = new Element('div',{'class': 'choiceContent clickable','action-name': 'content'});
		liTmp.insert({top: divTmp});
		tmpEl = new Element('span',{'class': 'choiceOption','action-name': 'choice','action-value': key,'parent-id': this.holderEl.id}).update(value);
		divTmp.insert({top: tmpEl});

		if (!this.emptySelectionDisabled || (this.defaultKey && this.defaultKey != key)) {
			closeEl = new Element('a',{'class': 'choiceOptionClose', 'action-name': 'close', 'href': 'javascript:;'});
			closeEl.observe('click',function(evt) {
				//Event.stop(evt);
				//_this.removeChoice(key,{source: 'user',skipOpen: true});
				_this.fire('choice:remove',{'key': key});
			});
			tmpEl.insert({
				bottom: closeEl
			});
		}
	},
	insertHtmlChoice: function(tmpEl, first) {
		var first = first || false;
		try {
			var insertEl = null;
			var insertPos = null;
			
			if (first) {
				try {
					insertEl = this.holderEl.select('[action-name=choice-first-options-insert]')[0];
				} catch(e) {}			
			}
			
			if (!insertEl) {
				try {
					insertEl = this.holderEl.select('[action-name=choice-options-insert]')[0];
				} catch(e) {}
				if (!insertEl && this.holderEl.readAttribute('action-name') == 'choice-options-insert') {
					insertEl = this.holderEl;
				}
			}
			
			insertPos = insertEl.readAttribute('choice-option-insert-position');

			var params = {};
			params[insertPos] = tmpEl;
			insertEl.insert(params);
			tmpEl.show();
		} catch(e) {}
	},
	removeHtmlChoice: function(key) {
		try {
			this.choicesHtml.get(key).remove();
		} catch(e) {}
	},
	removeHtmlChoices: function() {
		this.choicesHtml.each(function(o) {
			try {
				o.value.remove();
				
			} catch(e) {}
		});
		
		this.choicesHtml = $H({});
	},
	setChoiceSelector: function(obj) {
		this.choiceSelector = obj;
	},
	updateEmptyClass: function() {
		if (this.choices.size() > 0) {
			this.holderEl.addClassName('notEmpty');
			if (this.hideWhenEmpty) {
				this.show();				
			}
		} else {
			this.holderEl.removeClassName('notEmpty');
			if (this.hideWhenEmpty) {
				this.hide();
			}
		}
		/*
		if (!this.hideWhenEmpty) {
			this.show();
		}*/
		if (this.choices.size() > 1) {
			//this.holderEl.addClassName('joinNext');
		} else {
			//this.holderEl.removeClassName('joinNext');
		}
	},
	updateSelector: function() {
		if (this.choiceSelector && this.choiceSelector.updateSelections)
			this.choiceSelector.updateSelections();
	},
	updateStorage: function() {
		if (this.valueStorage && this.valueStorage.set) {
			this.valueStorage.set(this.getKeys().join(','));
		}
	},
	observe: function(eventName, func) {
		var o = this.observs.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observs.set(eventName, o);
	},
	fire: function(eventName, params) {
		var params = params || {};
		var evt = {};
		//var evt = new Event(eventName);
		evt['memo'] = params;
		var o = this.observs.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				//o[i].defer(evt);
				o[i](evt); 
			}
		}
	}
});



var kpFormValueSelection = Class.create({
	initialize: function(options) {

		var i;
		if (!options) options = {};
		this.menuGroups = [];
		this.menuItems = [];
		this.documentClickTimeout = {};
		this.searchText = '';
		this.searchTextUpdated = 0;
		
		if (options['valuesSource']) this.valuesSource = options['valuesSource'] || false;
		//if (options['selectionDest']) this.selectionDest = options['selectionDest'];
		
		this.holderEl = options['holderEl'] || null;
		
		if (options['columns']) this.columns = options['columns'];
		else this.columns = 5;
		if (options['hideCountMin']) this.hideCountMin = options['hideCountMin'];
		else this.hideCountMin = 0;
		if (options['disableCountMin']) this.disableCountMin = options['disableCountMin'];
		else this.disableCountMin = 0;
		if (options['disableCountText']) this.disableCountText = options['disableCountText'];
		else this.disableCountText = '';
		if (options['recentValues']) this.recentValues = options['recentValues'];
		else this.recentValues = [];
		if (options['recentValuesMaxCount']) this.recentValuesMaxCount = options['recentValuesMaxCount'];
		else this.recentValuesMaxCount = 2;
		if (options['enableKeywordSearch']) this.enableKeywordSearch = options['enableKeywordSearch'];
		this.skipOptionsEmptyValue = options['skipOptionsEmptyValue'] || false;
		
		this.onDocumentClickBind = this.onDocumentClick.bind(this);
		
		this.options = options;
		
		this.observs = $H({});
		
		// Prepare bounded onKeyPress
		this.boundedOnKeyPress = this.onKeyPress.bind(this);
		this.boundedOnKeyUp = this.onKeyUp.bind(this);

	},
	onDomLoaded: function(event) {
		this.init();
	},
	initOnDocumentLoaded: function() {
		if (document.loaded)
			this.onDomLoaded();
		else
			document.observe('dom:loaded',this.onDomLoaded.bind(this));
	},
	init: function() {
				
		// Generate DIV elements
		try {
			if (this.menuButtonHolder) this.menuButtonHolder.remove();
			if (this.menuHolderDiv) this.menuHolderDiv.remove();	
		} catch(e) {}

		this.menuButtonHolder = new Element('div',{'style': 'position: relative;','class': 'uiInlineBlock'});
		this.menuButton = new Element('div',{'class': 'uiMenuButton'});

		try {
			var firstText = '....'; //this.valuesSource.defaultValue();
		} catch(e) {}
		this.menuButton.innerHTML = '<div class="uiMenuButtonOuter"><div class="uiMenuButtonInner"><span id="dropdown">&nbsp;▼</span><span id="caption">'+firstText+'</span></div></div>';
		this.menuButtonHolder.insert({bottom: this.menuButton});
		
		this.menuButtonHolder.observe('click',this.onMenuButtonClick.bind(this));
		
		this.menuHolderDiv = new Element('div',{});
		
		$(this.holderEl).insert({
			bottom: this.menuHolderDiv
		});
		
		this.menuHolderDiv.setAttribute('class','uiInlineBlock uiMenuHolder');
		this.menuHolderDiv.setStyle({top: '0px',left: '0px'});
		this.hideMenuHolder();
		
		//this.menuHolderDiv.observe('keyup',this.boundedOnKeyPress);
		//this.selectEl.observe('keyup',this.boundedOnKeyPress);
		
		this.menuHolderIFrame = new Element('iframe',{frameborder: 0,src: 'about:blank',style: 'position: absolute; margin: 0; padding: 0; border: 0px;'});
		this.menuHolderDiv.insert({
			top: this.menuHolderIFrame
		});

		// Keyword search
		if (this.enableKeywordSearch) {
			this.keywordSearchDiv = new Element('div',{});
			this.menuHolderDiv.insert({top: this.keywordSearchDiv});
			
			this.keywordSearchDiv.innerHTML = '';//'Izaberite mesto/grad: ';
			this.keywordInput = new Element('input',{type: 'text'});
			this.onKeywordKeyup = this._onKeywordKeyup.bind(this);
			this.keywordInput.observe('keyup',this.onKeywordKeyup);
			this.keywordInput.observe('keypress',this.onKeywordKeyup);
			this.keywordInput.observe('focus',function() {this.keywordInput.focused = true}.bind(this));
			this.keywordInput.observe('blur',function() {this.keywordInput.focused = false}.bind(this));
			this.keywordSearchDiv.insert({bottom: this.keywordInput});
		}
		// end keyword search
		
		this.menuGroupsHolderDiv = new Element('div',{});
		this.menuGroupsHolderDiv.addClassName('uiInlineBlock uiMenuGroupsHolder');
		if (this.options['limitMenuGroupsHolderHeight'] > 0) {
			this.menuGroupsHolderDiv.setStyle({maxHeight: this.options['limitMenuGroupsHolderHeight']+'px',overflowY: 'auto', overflowX: 'hidden',paddingRight: '15px'});			
		}
		this.menuHolderDiv.insert({bottom: this.menuGroupsHolderDiv});
		
		for (i=0;i<this.columns;i++) {
			this.menuGroups[i] = new Element('div',{});
			this.menuGroups[i].setAttribute('class','uiMenuGroup');
			this.menuGroups[i].setAttribute('id','menuGroup'+i);
			this.menuGroupsHolderDiv.insert({
				bottom: this.menuGroups[i]
			});
		}
		
		this.initElements('');
		
		this.initRecentLinks();

		if (this.hideCountMin > this.valuesSource.size())
			this.menuButtonHolder.hide();
		else
			this.menuButtonHolder.show();

		/*
		if (this.disableCountMin > this.selectEl.options.length) {
			this.menuHolderDiv.hide();
			if (this.disableCountText != '')
				this.setCaption(this.disableCountText);
		}
		*/

		//this.menuHolderIFrame.clonePosition(this.menuHolderDiv,{setLeft: false, setTop: false, setWidth: true, setHeight: true});
		if (this.menuHolderIFrame && this.menuHolderIFrame.setStyle)
			this.menuHolderIFrame.setStyle({top: '0px',left: '0px',width: '1000px',height: '1000px',backgroundColor: '#ffffff',zIndex: '-1'});
						
		//this.setValue(this.getMenuItemByValue(this.selectEl.value).getAttribute('data-text'));
	},
	initElements: function(text) {
		var i,ii;
		
		this.initializingElements = true;
		this.initializingElementsText = text;

		// Empty columens
		for (i=0;i<this.columns;i++) {
			if (this.menuGroups[i] && this.menuGroups[i].innerHTML != undefined) {
				this.menuGroups[i].innerHTML = '';
			} else {
				return;
			}
		}
		
		// Populate menuItems and menuItemValues arrays
		this.menuItems = [];
		this.menuItemValues = [];
		var _this = this;
		this.valuesSource.search(text, function(o) {
			if (_this.skipOptionsEmptyValue && o.key == '') return;
			
			var menuItem = new Element('div',{});
			menuItem.setAttribute('class','uiMenuItem');
			menuItem.setAttribute('data-action','menu-item');
			menuItem.setAttribute('data-value',o.key);
			menuItem.setAttribute('data-text',o.value);
			menuItem.innerHTML = o.value;
			var ii;
			ii = _this.menuItems.length;
			menuItem.setAttribute('data-index',ii);
			_this.menuItems[ii] = menuItem;
			_this.menuItemValues[ii] = o.key;
			_this.menuItems[ii].observe('click',_this.onMenuItemClick.bind(_this,o.key));
			_this.menuItems[ii].observe('mouseover',_this.onMenuItemHover.bind(_this,o.key));
		});

		this.perColumn = Math.ceil(this.menuItems.length/this.columns);
		for (i=0;i<this.menuItems.length;i++) {
			var g = Math.floor(i/this.perColumn);
			this.menuGroups[g].insert({
				bottom: this.menuItems[i]
			});
		}
		
		this.initializingElements = false;
		
		if (text != '')
			this.selectBySearchText(text);

	},
	initRecentLinks: function() {
		// Generate recent links
		try {
			//if (this.recentValuesHolder) this.recentValuesHolder.remove();
			var shownRecent = 0;
			try {
				this.recentValuesHolder.remove();
			} catch(e) {}
			if (this.recentValues && this.recentValues.length > 0) {
				this.recentValuesHolder = new Element('div',{'class': 'uiMenuRecentValuesHolder clearfix'});
				this.recentValuesHolder.insert({
					top: new Element('span',{'class': 'caption'}).update('Prethodno izabrano: ')
				});
				for (i=0;i<this.recentValues.length;i++) {
					var val = this.recentValues[i];
					if (this.menuItemValues.indexOf(val) >= 0) {
						var mItem = this.getMenuItemByValue(val)
						if (mItem) {
							shownRecent++;
							var text = mItem.getAttribute('data-text');
							var recentMenuItem = new Element('div',{'class': 'uiInlineBlock menuItemRecent'}).update(text);
							recentMenuItem.observe('click',this.onMenuItemClick.bind(this,val));
							this.recentValuesHolder.insert({
								bottom: recentMenuItem
							});
							if (shownRecent >= this.recentValuesMaxCount) break;
						}					
					}
				}
				if (shownRecent)
					this.menuGroups[0].insert({before: this.recentValuesHolder});
			}
		} catch(e) {}
		// ---------------------
	},
	setHolder: function(holderEl) {
		var holderEl = holderEl || null;
		this.holderEl = holderEl;
		
		if (this.holderEl && this.menuHolderDiv) {
			var tmpEl = this.menuHolderDiv.remove();
			$(this.holderEl).insert({
				bottom: this.menuHolderDiv
			});
			this.menuHolderDiv.hide();
			this.menuHolderDiv.show();
		}		
	},
	getHolder: function() {
		return this.holderEl;
	},
	setValue: function(value,params) {
		if (!params) params = {};
		try {
			this.setCaption(this.getMenuItemByValue(value).getAttribute('data-text'));		
		} catch(e) {}
	},
	setCaption: function(caption) {
		this.menuButton.select('#caption')[0].innerHTML = caption;
	},
	onMenuItemClick: function(key,event) {
		clearTimeout(this.documentClickTimeout);
		try {
			if (this.keywordInput) {
				if (this.keywordInput.value != '') {
					this.keywordInput.value = '';
					this.initElements('');
				}
			}
		} catch(e) {}

		this.fire('choice:click',{'key': key, source: 'user'});

		//this.updateSelections();
		//this.hideMenuHolder();
	},
	onMenuItemHover: function(key,event) {
		// remove highlighted class
		this.menuHolderDiv.select('.highlighted').each(function(el,index) {
			el.removeClassName('highlighted');
		});		
	},
	updateSelections: function() {
		this.clearCurrentSelections();
		
		/*
		try {
			var _this = this;
			var vals = this.selectionDest.getKeys().each(function(key) {
				_this.getMenuItemByValue(key).addClassName('uiMenuItemSelected');
			});
		} catch(e) {}
		*/
	},
	clearCurrentSelection: function() {
		var curValue = this.selectEl.value;
		try {
			this.getMenuItemByValue(curValue).removeClassName('uiMenuItemSelected');
		} catch(e) {}
	},
	clearCurrentSelections: function() {
		try {
			this.menuHolderDiv.select('.uiMenuItemSelected').each(function(el) {
				el.removeClassName('uiMenuItemSelected');
			});
		} catch(e) {}
	},
	onMenuButtonClick: function(event) {
		//event.stop();
		clearTimeout(this.documentClickTimeout);
		
		if (this.disableCountMin > this.selectEl.options.length) {
			document.stopObserving('click');
			this.hideMenuHolder();
			if (this.disableCountText != '')
				this.setCaption(this.disableCountText);
			return;
		}
		/*
		var layout = Element.getLayout(this.menuButtonHolder);
		this.menuHolderDiv.setStyle({
			top: (layout.get('top')+layout.get('height'))+'px'
		});
		*/
		// check if fixed position is used
		var useFixed = false;
		this.menuButtonHolder.ancestors().each(function(el) {
			if ($(el) && $(el).getStyle('position') == 'fixed') {
				useFixed = true;
			}
		});
		if (useFixed) this.menuHolderDiv.setStyle({position: 'fixed'});
		/*this.menuHolderDiv.clonePosition(this.menuButtonHolder,
			{setLeft: true, setTop: true, setWidth: false, setHeight: false,offsetTop: this.menuButtonHolder.getHeight()});*/

		if (this.menuHolderDiv.getStyle('display')) {
		} else {
			document.stopObserving('click');
			this.hideMenuHolder();
		}
	},
	show: function() {
		//document.observe('click',this.onDocumentClickBind);
		//this.showMenuHolder()

		if (this.enableKeywordSearch && this.keywordInput) {
			this.keywordInput.focus();
		}
		
		if (Prototype.Browser.IE) {
			document.observe('keydown',this.boundedOnKeyUp);
			document.observe('keypress',this.boundedOnKeyPress);
		} else {
			Event.observe(document,'keydown',this.boundedOnKeyUp);
			Event.observe(document,'keypress',this.boundedOnKeyPress);
		}		
	},
	hide: function() {
		//document.stopObserving('click',this.onDocumentClickBind);
		//this.hideMenuHolder();
		/*if (this.selectionDest && this.selectionDest.isOpened() && this.selectionDest.close)
			this.selectionDest.close();*/

		try {
			if (Prototype.Browser.IE) {
				document.stopObserving('keydown',this.boundedOnKeyUp);
				document.stopObserving('keypress',this.boundedOnKeyPress);
			} else {
				Event.stopObserving(document,'keydown',this.boundedOnKeyUp);
				Event.stopObserving(document,'keypress',this.boundedOnKeyPress);
			}
		} catch(e) {
		}

	},
	onDocumentClick: function(event) {
		//this.documentClickTimeout = this.hideMenuHolder.bind(this).delay(1);
		var el = event.element();
		if (el.descendantOf(this.menuHolderDiv) || el.descendantOf(this.menuButtonHolder))
			return;
		this.hideMenuHolder();
	},
	onKeyPress: function(event) {
		if (!this.keywordInput || !this.keywordInput.focused) {
			event.stop();			
		}
	},
	onKeyUp: function(event) {
		//alert(event.charCode);
		/*var i,out = '';
		for (i in event)
			out += i + ' ';
		alert(out);*/
		var d = new Date();
		var tt = d.getTime() * 0.001;
		var ch = String.fromCharCode(event.charCode ? event.charCode : event.keyCode).toLowerCase();
		if (event.keyCode == Event.KEY_RETURN) {
			//alert(this.menuHolderDiv);
			this.menuHolderDiv.select('.highlighted').each(function(el,index) {
				el.removeClassName('highlighted');
				this.onMenuItemClick(el.getAttribute('data-value'),null);
				Event.stop(event);
			}.bind(this));
		} else if (event.keyCode == Event.KEY_UP) {
			var i = 0;
			this.menuHolderDiv.select('.highlighted').each(function(el,index) {
				el.removeClassName('highlighted');
				i = el.getAttribute('data-index');
			});
			var newKey = i-1;
			if (newKey < 0) newKey = 0
			if (this.menuItems[newKey]) {
				this.menuItems[newKey].addClassName('highlighted');
			}
		} else if (event.keyCode == Event.KEY_DOWN) {
			var i=0;
			this.menuHolderDiv.select('.highlighted').each(function(el,index) {
				el.removeClassName('highlighted');
				i = parseInt(el.getAttribute('data-index'));
			});
			var newKey = Math.max(0,Math.min(this.menuItems.length-1,i+1));
			if (this.menuItems[newKey])
				this.menuItems[newKey].addClassName('highlighted');
		} else if (event.keyCode == Event.KEY_LEFT) {
			var i=0;
			this.menuHolderDiv.select('.highlighted').each(function(el,index) {
				el.removeClassName('highlighted');
				i = parseInt(el.getAttribute('data-index'));
			});
			i = Math.max(0,i-this.perColumn);
			if (this.menuItems[i])
				this.menuItems[i].addClassName('highlighted');
		} else if (event.keyCode == Event.KEY_RIGHT) {
			var i=0;
			this.menuHolderDiv.select('.highlighted').each(function(el,index) {
				el.removeClassName('highlighted');
				i = parseInt(el.getAttribute('data-index'));
			});
			i = Math.min(this.menuItems.length-1,i+this.perColumn);
			if (this.menuItems[i])
				this.menuItems[i].addClassName('highlighted');
		} else if (ch.search(/[a-z0-9žšđčć ]/i) > -1) {
			if (tt - this.searchTextUpdated > 1.5)
				this.searchText = ch;
			else 
				this.searchText += ch;
			this.searchTextUpdated = tt;
			if (!this.enableKeywordSearch)
				this.selectBySearchText(this.searchText);
		} else if (event.keyCode == Event.KEY_ESC) {
			this.hide();
		}
		if ((!this.keywordInput || !this.keywordInput.focused) && event.keyCode != Event.KEY_LEFT) {
			Event.stop(event);
		}
	},
	_onKeywordKeyup: function(e) {
		if (e.keyCode == Event.KEY_LEFT || e.keyCode == Event.KEY_RIGHT) {
			return false;
		}
		if (!this.initializingElements) {
			while (this.initializingElementsText != this.keywordInput.value)
				this.initElements(this.keywordInput.value);
		}
		return true;
	},
	selectBySearchText: function(text) {
		if (this.initializingElements) return;
		var i,value;
		
		var text = text || '';
		var sText = text.replace(/[^a-zA-Z0-9šđčćž� ĐČĆŽ]+$/g,'');
		var regExpPattern = '^'+sText;
		regExpPattern = regExpPattern.replace(/[s]/g,'[sš]');
		regExpPattern = regExpPattern.replace(/[c]/g,'[cčć]');
		regExpPattern = regExpPattern.replace(/[z]/g,'[zž]');
		regExpPattern = regExpPattern.replace(/dj/g,'(dj|đ)');
		var regExp = new RegExp(regExpPattern,'i');

		for (i=0;i<this.menuItems.length;i++) {
			value = this.menuItems[i].getAttribute('data-text').toLowerCase();
			//if (value.indexOf(text.toLowerCase()) == 0) {
			if (regExp.test(value)) {
				//this.clearCurrentSelection();
				//this.setValue(i);
				this.menuHolderDiv.select('.highlighted').each(function(el,index) {
					el.removeClassName('highlighted');
				});
				this.menuItems[i].addClassName('highlighted');
				break;
			}			
		}
	},
	hideMenuHolder: function() {
		//this.menuHolderDiv.hide();
		try {
			if (Prototype.Browser.IE) {
				document.stopObserving('keydown',this.boundedOnKeyUp);
				document.stopObserving('keypress',this.boundedOnKeyPress);
			} else {
				Event.stopObserving(document,'keydown',this.boundedOnKeyUp);
				Event.stopObserving(document,'keypress',this.boundedOnKeyPress);
			}
		} catch(e) {}
	},
	showMenuHolder: function() {
		//this.menuHolderDiv.show();
		if (this.enableKeywordSearch)
			this.keywordInput.focus();
		//document.stopObserving('keypress');
		if (Prototype.Browser.IE) {
			document.observe('keydown',this.boundedOnKeyUp);
			document.observe('keypress',this.boundedOnKeyPress);
		} else {
			Event.observe(document,'keydown',this.boundedOnKeyUp);
			Event.observe(document,'keypress',this.boundedOnKeyPress);
		}
	},
	getMenuItemByValue: function(value) {
		var i;
		for (i=0;i<this.menuItems.length;i++)
			if (this.menuItems[i].getAttribute('data-value') == value)
				return this.menuItems[i];
	},
	observe: function(eventName, func) {
		var o = this.observs.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observs.set(eventName, o);
	},
	fire: function(eventName, params) {
		var params = params || {};
		var evt = {};
		//var evt = new Event(eventName);
		evt['memo'] = params;
		var o = this.observs.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				o[i].defer(evt);
			}
		}
	}
});

var kpFormPriceSearchSelection = Class.create({
	initialize: function(options) {
		if (options['selectionDest']) this.selectionDest = options['selectionDest'];

		this.options = options;
		
		this.initDone = false;
		this.setInitValues = false;
		
		this.observs = $H({});

		if (document.loaded)
			this.onDomLoaded();
		else
			document.observe('dom:loaded',this.onDomLoaded.bind(this));
	},
	onDomLoaded: function(event) {
		this.init();
	},
	initOnDocumentLoaded: function() {
		if (document.loaded)
			this.onDomLoaded();
		else
			document.observe('dom:loaded',this.onDomLoaded.bind(this));
	},
	init: function() {
		this.holderEl = $(this.options['holderEl']);
		
		this.parentEl = $(this.options['parentEl']);
		
		this.priceMin = this.parentEl.select('[action-name=price-min]')[0];
		this.priceMax = this.parentEl.select('[action-name=price-max]')[0];
		this.currencyRSD = this.parentEl.select('[action-name=currency-rsd]')[0];
		this.currencyEUR = this.parentEl.select('[action-name=currency-eur]')[0];
		this.withPriceOnly = this.parentEl.select('[action-name=with-price-only]')[0];
		this.priceTextBesplatno = this.parentEl.select('[action-name=price-text-besplatno]')[0];
		this.priceTextDogovor = this.parentEl.select('[action-name=price-text-dogovor]')[0];
		this.auction = this.parentEl.select('[action-name=auction-yes]')[0];
		this.exchange = this.parentEl.select('[action-name=exchange-yes]')[0];
		this.confirmButton = this.parentEl.select('[action-name=confirm]')[0];
		this.resetButton = this.parentEl.select('[action-name=reset]')[0];

		this.initObservers();

		this.updateSelectionDest();
		
		this.initDone = true;
		
		if (this.setInitValues) {
			this.setValues(this.setInitValues);
		}
	},
	initObservers: function() {
		var _this = this;
		
		try {
			this.parentEl.select('[action-name=choice-menu-close]').each(function(el) {
				el.observe('click',function(ev) {
					_this.fire('close');
				});
			});
		} catch(e) {}
		
		var onKeyUp = function(evt) {
			if (evt.keyCode == Event.KEY_RETURN) {
				Event.stop(evt);
				_this.updateSelectionDest();
				_this.fire('close');
				//_this.selectionDest.close();
			}
		};
		this.priceMin.observe('keydown',onKeyUp);
		this.priceMax.observe('keydown',onKeyUp);
		this.currencyRSD.observe('keydown',onKeyUp);
		this.currencyEUR.observe('keydown',onKeyUp);

		if (this.priceTextBesplatno) {
			this.priceTextBesplatno.observe('click',function(ev) {
				_this.priceTextChanged();
			});
		}
		if (this.priceTextDogovor) {
			this.priceTextDogovor.observe('click',function(ev) {
				_this.priceTextChanged();
			});
		}
		if (this.withPriceOnly) {
			this.withPriceOnly.observe('click',function(ev) {
				_this.withPriceOnlyChanged();
			});
		}
		
		this.confirmButton.observe('click',function(evt) {
			Event.stop(evt);
			_this.updateSelectionDest();
			_this.fire('close');
			//_this.selectionDest.close();
		});
		this.resetButton.observe('click',function(evt) {
			Event.stop(evt);
			//_this.selectionDest.removeChoice('1');
			_this.updateSelectionDest({skipClose: true});
			//_this.selectionDest.close();
		});
		if (this.options['autocompleteEventKeyParam'] && this.options['autocompleteEventValueParam']) {
			document.observe('kpAC:change',function(evt) {
				if (evt.memo) {
					var changed = false;
					if (evt['memo']['price_min']) {
						this.priceMin.value = evt['memo']['price_min'];
						changed = true;
					}
					if (evt['memo']['price_max']) {
						this.priceMax.value = evt['memo']['price_max'];
						changed = true;
					}
					if (evt['memo']['price_currency']) {
						if (evt['memo']['price_currency'] == 'eur') {
							this.currencyEUR.checked = true;
							changed = true;
						}
						else if (evt['memo']['price_currency'] == 'rsd') {
							this.currencyRSD.checked = true;
							changed = true;
						}
					}
					
					if (changed) {
						_this.updateSelectionDest();
						//_this.selectionDest.close();			
					}
				}
			});
		}

	},
	setHolder: function(holderEl) {
		var holderEl = holderEl || null;
		this.holderEl = holderEl;
		
		if (this.holderEl && this.parentEl) {
			var tmpEl = this.parentEl.remove();
			$(this.holderEl).insert({
				bottom: this.parentEl
			});
			this.parentEl.hide();
			this.parentEl.show();
		}		
	},
	getHolder: function() {
		return this.holderEl;
	},
	setValues: function(values) {
		
		if (!this.initDone) {
			this.setInitValues = values;
		} else {
		
			var changed = false;
			if (values['price_min'] && parseInt(values['price_min']) > 0) {
				this.priceMin.value = parseInt(values['price_min']);
				changed = true;
			}
			if (values['price_max'] && parseInt(values['price_max']) > 0) {
				this.priceMax.value = parseInt(values['price_max']);
				changed = true;
			}
			if (values['currency']) {
				if (values['currency'] == 'rsd') {
					this.currencyRSD.checked = true;
				}	else if (values['currency'] == 'eur') {
					this.currencyEUR.checked = true;
				}
				changed = true;
			}
			if (values['has_price'] == 'yes' && this.withPriceOnly) {
				this.withPriceOnly.checked = true;
				changed = true;
			}
			if (values['price_text'] && values['price_text'].length > 0) {
				if (this.priceTextBesplatno && values['price_text'].indexOf('Besplatno') > -1) {
					this.priceTextBesplatno.checked = true;
					changed = true;
				}
				if (this.priceTextDogovor && values['price_text'].indexOf('Dogovor') > -1) {
					this.priceTextDogovor.checked = true;
					changed = true;
				}
			}			
			if (values['auction'] == 'yes') {
				this.auction.checked = true;
				changed = true;
			}
			if (values['exchange'] == 'yes') {
				this.exchange.checked = true;
				changed = true;
			}
			if (changed) {
				this.updateSelectionDest();
				//this.selectionDest.close();				
			}
		}
	},
	getText: function() {
		var p1 = this.getPriceMin();
		var p2 = this.getPriceMax();
		if (p1 > 0 && p2 > 0) {
			var priceMin = Math.min(p1,p2);
			var priceMax = Math.max(p1,p2);
		} else {
			priceMin = p1;
			priceMax = p2;
		}
		var currencySign = this.getCurrencySign();
		
		var text = '';
		if (priceMin && priceMax) text = 'od '+priceMin+' do '+priceMax;
		else if (priceMin) text = 'od '+priceMin;
		else if (priceMax) text = 'do '+priceMax;
		
		if (text) text += ' '+currencySign;
		
		var addText = $A([]);
		if (this.withPriceOnly.checked) addText.push('samo sa cenom');
		if (this.priceTextBesplatno && this.priceTextBesplatno.checked) addText.push('besplatno');
		if (this.priceTextDogovor && this.priceTextDogovor.checked) addText.push('dogovor');
		/*if (this.auction.checked) addText.push('aukcija');
		if (this.exchange.checked) addText.push('zamena moguća');*/
		
		if (addText.size() > 0) {
			text += ' ('+addText.join(', ')+')';
		}
		
		return text;
	},
	getPriceMin: function() {
		var p = parseInt(this.priceMin.value);
		if (p > 0) return p
		else return false;
	},
	getPriceMax: function() {
		var p = parseInt(this.priceMax.value);
		if (p > 0) return p
		else return false;
	},
	getCurrencySign: function() {
		if (this.currencyEUR.checked) return '&euro;';
		else return 'din';
	},
	show: function() {
		this.priceMin.focus();
		this.updateSelectionDest({skipClose: true});
	},
	hide: function() {
		this.updateSelectionDest({skipClose: true});
	},
	updateSelectionDest: function(params) {
		var params = params || {};
		try {
			var text = this.getText();
			if (text > '') {
				//this.selectionDest.addChoice('1', text,params);
				this.fire('choice:click',{'key': '1', 'value': text, source: 'user'});
			} else {
				this.fire('choice:remove',{'key': '1', source: 'user'});
			}
			
			if (this.auction.checked) {
				this.fire('choice:click',{'key': 'auction', 'value': 'aukcija', source: 'user'});
			} else {
				this.fire('choice:remove',{'key': 'auction', source: 'user'});
			}

			if (this.exchange.checked) {
				this.fire('choice:click',{'key': 'exchange', 'value': 'zamena moguća', source: 'user'});
			} else {
				this.fire('choice:remove',{'key': 'exchange', source: 'user'});
			}			

		} catch(e) {}
	},
	updateSelections: function() {
		if (this.selectionDest && this.selectionDest.getKeys) {
			var k = this.selectionDest.getKeys();
			if (k.indexOf('1') < 0) {
				this.priceMin.value = '';
				this.priceMax.value = '';
				this.withPriceOnly.checked = false;
			}
			if (k.indexOf('auction') < 0) {
				this.auction.checked = false;
			}
			if (k.indexOf('exchange') < 0) {
				this.exchange.checked = false;
			}
		}
	},
	resetPriceFilters: function() {
		this.priceMin.value = '';
		this.priceMax.value = '';
		this.withPriceOnly.checked = false;
		this.priceTextBesplatno.checked = false;
		this.priceTextDogovor.checked = false;
	},
	resetAuctionFilter: function() {
		this.auction.checked = false;
	},
	resetExchangeFilter: function() {
		this.exchange.checked = false;
	},
	priceTextChanged: function() {
		if ((this.priceTextBesplatno && this.priceTextBesplatno.checked) ||
				(this.priceTextDogovor && this.priceTextDogovor.checked)
		) {
				this.withPriceOnly.checked = false;
		}
	},
	withPriceOnlyChanged: function() {
		if (this.withPriceOnly.checked) {
			if (this.priceTextBesplatno) this.priceTextBesplatno.checked = false;
			if (this.priceTextDogovor) this.priceTextDogovor.checked = false;
		}
	},
	observe: function(eventName, func) {
		var o = this.observs.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observs.set(eventName, o);
	},
	fire: function(eventName, params) {
		var params = params || {};
		var evt = {};
		//var evt = new Event(eventName);
		evt['memo'] = params;
		var o = this.observs.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				o[i].defer(evt);
			}
		}
	}
});


var kpChoiceValuesStoreInputHidden = Class.create({
	initialize : function(options) {
		this.options = options || {};
		
		this.input = false;
		this.form = false;
		
		if (this.options['input']) {
			this.input = $(this.options['input']);			
		} else if (this.options['form']) {
			this.form = $(this.options['form']);
		}
		
		if (this.options['inputName']) {
			this.inputName = this.options['inputName'];
			if (!this.input && this.form) {
				var ii = this.form.getInputs('hidden',this.inputName);
				if (ii && ii.size() > 0) {
					this.input = ii[0];
				}
			}
		}
		
		if (!this.form && this.input && this.input.form) {
			this.form = $(this.input.form);
		}
		
		// Add input 
		if (!this.input && this.inputName > '' && this.form) {
			this.input = new Element('input',{'type': 'hidden','name': this.inputName});
			this.form.insert({bottom: this.input});
		}
	},
	get: function() {
		if (this.input) {
			return this.input.value;
		}
	},
	set: function(value) {
		if (this.input) {
			this.input.value = value;
		}
	}
});

var kpChoiceValuesSourceArray = Class.create({
	initialize : function(options) {
		this.options = options || {};
		
		this.values = $A(this.options['values']);
		
		this.keyName = this.options['keyName'] || 'key';
		this.valueName = this.options['valueName'] || 'value';
	},
	getValue: function(key) {
		var _this = this;
		var ret = this.values.findAll(function(el) {
			return el[_this.keyName] == key;
		})
		if (ret && ret.size() > 0) 
			return ret[0][this.valueName];
		else 
			return undefined;
	},
	getValueAttribute: function(key,attrName) {
		var _this = this;
		var ret = this.values.findAll(function(el) {
			return el[_this.keyName] == key;
		})
		if (ret && ret.size() > 0) {
			if (ret[0]['attributes'] && ret[0]['attributes'][attrName]) {
				return ret[0]['attributes'][attrName];
			}
		} 
		return undefined;
	},
	getValues: function(keys) {
		var ret = false;
		if (keys.length != undefined) {			
			var i;
			for (i=0;i<keys.length;i++) {				
				var val = this.getValue(keys[i]);
				if (val) {
					if (ret == false) ret = {};
					ret[keys[i]] = val;
				}
			}
		} else {
			ret = {};
			ret[keys] = this.getValue(key);
		}
		return ret;
	},
	each: function(f) {
		var _this = this;
		this.values.each(function(el) {			
			f({key: el[_this.keyName], value: el[_this.valueName]});
		});
	},
	size: function() {
		return this.values.size();
	},
	search: function(text, f) {
		var _this = this;
		var text = text || '';

		var sText = text.replace(/[^a-zA-Z0-9šđčćž� ĐČĆŽ]+$/g,'');
		var regExpPattern = '('+sText.replace(/[^a-zA-Z0-9šđčćž� ĐČĆŽ]+/g,'|')+')';
		regExpPattern = regExpPattern.replace(/[s]/g,'[sš]');
		regExpPattern = regExpPattern.replace(/[c]/g,'[cčć]');
		regExpPattern = regExpPattern.replace(/[z]/g,'[zž]');
		regExpPattern = regExpPattern.replace(/dj/g,'(dj|đ)');
		var regExp = new RegExp(regExpPattern,'i');

		this.values.each(function(el) {
			if (!text || text == '' || regExp.test(el[_this.valueName])) {
				f({key: el[_this.keyName], value: el[_this.valueName]});
			}
		});
	}
});

var kpChoiceValuesSourceArrayAjax = Class.create({
	initialize : function(options) {
		this.options = options || {};
		
		this._source = new kpChoiceValuesSourceArray({
			values: this.options['values'] || []
		});
		this.url = this.options['url'] || '';
		//this.values = $H(this.options['values'] || {});
		this.params = $H(this.options['params'] || {});
		
		this.keyName = this.options['keyName'] || 'category_id';
		this.valueName = this.options['valueName'] || 'name';
		this.loadedValuesKey = '';
		this.loadingValues = false;
		this.initialValuesSource = false;
		this.initialValues = this.options['initialValues'] || false;
		if (this.initialValues) {
			this.initialValuesSource = new kpChoiceValuesSourceArray({
				values: this.options['initialValues'],
				keyName: this.options['keyName'],
				valueName: this.options['valueName']
			});
		}
		
		this.observs = $H({});
		this.observsOnce = $H({});
		
		this.cache = {};
	},
	getValue: function(key, params) {
		var params = params || false;
		var value = this._source.getValue(key);
		var _this = this;

		if (value === undefined && !params['skipInitialValues'] && this.initialValuesSource) {
			var initValue = this.initialValuesSource.getValue(key);
			if (initValue) {
				value = initValue;
			}
		}
		
		if (value === undefined && params && params['onValueLoad']) {
			this.update({
				successCallback: function() {
					value = _this._source.getValue(key);
					params['onValueLoad'](value);
				}
			});
		}
		
		return value;
	},
	getValueAttribute: function(key,attrName) {
		var value = this._source.getValue(key);
		if (value) {
			return this._source.getValueAttribute(key,attrName);
		} else if (this.initialValuesSource) {
			return this.initialValuesSource.getValueAttribute(key,attrName);
		}
	},
	getValues: function(keys) {
		var ret = false;
		if (keys.length != undefined) {			
			var i;
			for (i=0;i<keys.length;i++) {				
				var val = this._source.getValue(keys[i]);
				if (val) {
					if (ret == false) ret = {};
					ret[keys[i]] = val;
				}
			}
		} else {
			ret = {};
			ret[keys] = this._source.getValue(key);
		}
		return ret;
	},
	'each': function(f) {
		this._source.each(f);
	},
	size: function() {
		return this._source.values.size();
	},
	setParam: function(key, value) {
		this.params.set(key,value);
	},
	update: function(params) {
		this.loadingValues = true;
		var params = params || {};
		var url = this.url; //'ajax_functions.php?action=get_groups';
		var ajaxParams = this.params;
		if (!ajaxParams['active']) ajaxParams['active'] = 'yes,view';
		var _this = this;
		
		var cacheKey = Object.toJSON(ajaxParams);
		if (cacheKey == this.loadedValuesKey) {
			_this.loadingValues = false;
			
			if (params['successCallback']) {
				params['successCallback']();
			}
			
			return;
		} else if (this.cache[cacheKey]) {
			_this.loadingValues = false;		
			
			this._source.values = this.cache[cacheKey];
			this.loadedValuesKey = cacheKey;
			this.loadedingValuesKey = '';

			if (params['successCallback']) {
				params['successCallback']();
			}
			
			_this.fire('values:loaded');
			
			return;
		} else if (_this.loadedingValuesKey == cacheKey) {
			if (params['successCallback']) {
				params['successCallback']();
			}
			
			return;
		}
		
		_this.loadedingValuesKey = cacheKey;
		_this.fire('values:loading');
		new Ajax.Request(url, {
				asynchronous:true,
				parameters: ajaxParams,
				onComplete:function(req) {
					_this.loadingValues = false;
					_this.loadedValuesKey = cacheKey;
					
					if (req.readyState == 4) {
						if (req.status == 200) {
							var json = req.responseText.evalJSON(true);
							
							_this.originalValues = json;
							_this._source.values = $A([]);
							json.each(function(el) {
								if (el[_this.keyName] != undefined && el[_this.valueName] != undefined)
									//_this._source.values.push({key: el['category_id'],value: el['name'],attributes: el}); // Should be set by options
									_this._source.values.push({key: el[_this.keyName],value: el[_this.valueName],attributes: el});
							});
							
							if (params['successCallback']) {
								params['successCallback']();
							}						
							
							_this.cache[cacheKey] = _this._source.values;
						}
					}
					
					_this.fire('values:loaded');
				}
		});
	},
	search: function(text, f) {
		this._source.search(text,f);
	},
	observe: function(eventName, func) {
		var o = this.observs.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observs.set(eventName, o);
	},
	observeOnce: function(eventName, func) {
		var o = this.observsOnce.get(eventName);
		if (!o) o = [];
		o.push(func);
		this.observsOnce.set(eventName, o);
	},
	fire: function(eventName, params) {
		var params = params || {};
		var evt = {};
		//var evt = new Event(eventName);
		evt['memo'] = params;
		var o = this.observs.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				o[i].defer(evt);
			}
		}

		var o = this.observsOnce.get(eventName);
		var i;
		if (o && o.length > 0) {
			for (i=0;i<o.length;i++) {
				o[i].defer(evt);
			}
		}
		this.observsOnce.unset(eventName);

	}	
});

var kpGroupsValuesSource = Class.create(kpChoiceValuesSourceArrayAjax, {
	initialize : function($super,options) {
		$super(options);
	},
	update: function($super, params) {
		var ajaxParams = this.params;
		var cid = ajaxParams.get('category_id');
		if (!cid) {
			var cacheKey = Object.toJSON(ajaxParams);
			this.cache[cacheKey] = $A([]);
		}
		
		$super(params);
	}
});

var kpChoiceValuesSourceHash = Class.create({
	initialize : function(options) {
		this.options = options || {};
		
		this.values = $H(this.options['values']);
	},
	getValue: function(key) {
		return this.values.get(key);
	},
	'each': function(f) {
		this.values.each(f);
	},
	size: function() {
		return this.values.size();
	},
	search: function(text, f) {
		var text = text || '';

		var sText = text.replace(/[^a-zA-Z0-9šđčćž� ĐČĆŽ]+$/g,'');
		var regExpPattern = '('+sText.replace(/[^a-zA-Z0-9šđčćž� ĐČĆŽ]+/g,'|')+')';
		regExpPattern = regExpPattern.replace(/[s]/g,'[sš]');
		regExpPattern = regExpPattern.replace(/[c]/g,'[cčć]');
		regExpPattern = regExpPattern.replace(/[z]/g,'[zž]');
		regExpPattern = regExpPattern.replace(/dj/g,'(dj|đ)');
		var regExp = new RegExp(regExpPattern,'i');

		this.values.each(function(el) {
			if (!text || text == '' || regExp.test(el.value)) {
				f(el);
			}
		});
	}
});

var kpSearch = Class.create({

	initialize : function(options) {
		this.options = options || {};

		this.fields = {};
		this.form = $(this.options['formEl']);
		this.formHolder = $(this.options['formHolderEl']);

		this.initFormFields();
		this.initObservers();

		if (this.options['initiallyOpen']) {
			this.open();
		}

		document.observe('click',this.onSearchFiltersOutsideClick.bind(this));
	},
	initFormFields: function() {
		var _this = this;
		
		createFormChoicesDisplay({
			holderId: 'locationSelection',
			insertEl: 'locationInsertSpot',
			insertPosition: 'bottom'
		});
		if (!$('locationSecondSelection')) {
			createFormChoicesDisplay({
				templateEl: 'choiceListSecondDisplayTemplate',
				holderId: 'locationSecondSelection',
				insertEl: 'locationSecondInsertSpot',
				insertPosition: 'after'
			});
		}
		this.locationField = new kpLocationSearchField({
			recentValues: recentlyUsedValues && recentlyUsedValues['location_id'] ? recentlyUsedValues['location_id'] : []
		});
		this.fields['location'] = this.locationField;

		createFormChoicesDisplay({
			holderId: 'locationRadiusSelection',
			insertEl: 'locationInsertSpot',
			insertPosition: 'bottom',
			keepHidden: true
		});
		if (!$('locationRadiusSecondSelection')) {
			createFormChoicesDisplay({
				templateEl: 'choiceListSecondDisplayTemplate',
				holderId: 'locationRadiusSecondSelection',
				insertEl: 'locationRadiusSecondInsertSpot',
				insertPosition: 'after',
				keepHidden: true
			});
		}
		this.locationRadiusField = new kpLocationRadiusSearchField();
		if (this.locationField.getKey() > '') {
			this.locationRadiusField.show();
		} else {
			this.locationRadiusField.hide();
		}
		this.fields['location_radius'] = this.locationRadiusField;

		createFormChoicesDisplay({
			holderId: 'adKindSelection',
			insertEl: 'adKindInsertSpot',
			insertPosition: 'top'
		});
		if (false && !$('adKindSecondSelection')) {
			createFormChoicesDisplay({
				templateEl: 'choiceListSecondDisplayTemplate',
				holderId: 'adKindSecondSelection',
				insertEl: 'adKindSecondInsertSpot',
				insertPosition: 'after',
				keepHidden: true
			});
		}
		this.adKindField = new kpAdKindSearchField();
		this.fields['ad_kind'] = this.adKindField;

		createFormChoicesDisplay({
			holderId: 'adTypeSelection',
			insertEl: 'adTypeInsertSpot',
			insertPosition: 'top'
		});
		if (!$('adTypeSecondSelection')) {
			createFormChoicesDisplay({
				templateEl: 'choiceListSecondDisplayTemplate',
				holderId: 'adTypeSecondSelection',
				insertEl: 'adTypeSecondInsertSpot',
				insertPosition: 'after',
				keepHidden: false
			});
		}
		this.adTypeField = new kpAdTypeSearchField();
		this.fields['ad_type'] = this.adTypeField;

		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'priceSecondSelection',
			insertEl: 'priceSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: false
		});
		this.priceField = new kpPriceSearchField({
			dummy: false,
			price_min: this.options['price_min'] || '',
			price_max: this.options['price_max'] || '',
			currency: this.options['currency'] || '',
			has_price: this.options['has_price'] || '',
			auction: this.options['auction'] || '',
			exchange: this.options['exchange'] || '',
			price_text: this.options['price_text'] || ''
		});
		this.fields['price'] = this.priceField;

		createFormChoicesDisplay({
			holderId: 'conditionSelection',
			insertEl: 'conditionInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'conditionSecondSelection',
			insertEl: 'conditionSecondInsertSpot',
			insertPosition: 'after',
			skipOddEvenCount: true
		});
		this.conditionField = new kpConditionSearchField();
		this.fields['condition'] = this.conditionField;

		createFormChoicesDisplay({
			holderId: 'photoSelection',
			insertEl: 'photoInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'photoSecondSelection',
			insertEl: 'photoSecondInsertSpot',
			insertPosition: 'after'
		});
		this.photoField = new kpPhotoSearchField();
		this.fields['photo'] = this.photoField;

		createFormChoicesDisplay({
			holderId: 'orderSelection',
			insertEl: 'orderInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'orderSecondSelection',
			insertEl: 'orderSecondInsertSpot',
			insertPosition: 'after'
		});
		this.orderField = new kpOrderSearchField({
			hasKeywords: this.options['hasKeywords'] || false,
			newestFirst: this.options['newestFirst'] || false
		});
		this.fields['order'] = this.orderField;

		createFormChoicesDisplay({
			holderId: 'periodSelection',
			insertEl: 'periodInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'periodSecondSelection',
			insertEl: 'periodSecondInsertSpot',
			insertPosition: 'after'
		});
		this.periodField = new kpPeriodSearchField();
		this.fields['period'] = this.periodField;

		/*
		createFormChoicesDisplay({
			holderId: 'carMakeSelection',
			insertEl: 'carMakeInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carMakeSecondSelection',
			insertEl: 'carMakeSecondInsertSpot',
			insertPosition: 'after'
		});
		var carMakeField = new kpCarMakeSearchField();*/

		createFormChoicesDisplay({
			holderId: 'carModelSelection',
			insertEl: 'carModelInsertSpot',
			insertPosition: 'bottom',
			keepHidden: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carModelSecondSelection',
			insertEl: 'carModelSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: true
		});
		this.carModelField = new kpCarModelSearchField({
			//carMakeObj: carMakeField,
			recentValues: recentlyUsedValues && recentlyUsedValues['car_model'] ? recentlyUsedValues['car_model'] : []
		});
		this.fields['car_model'] = this.carModelField;


		createFormChoicesDisplay({
			holderId: 'vehiclePowerMinSelection',
			insertEl: 'vehiclePowerInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			holderId: 'vehiclePowerMaxSelection',
			insertEl: 'vehiclePowerInsertSpot',
			insertPosition: 'bottom',
			skipOddEvenCount: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehiclePowerSecondMaxSelection',
			insertEl: 'vehiclePowerSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: true,
			skipOddEvenCount: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehiclePowerSecondMinSelection',
			insertEl: 'vehiclePowerSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: true
		});	var vehiclePowerField = new kpVehiclePowerSearchField();
		this.fields['vehicle_power'] = this.vehiclePowerField;

		createFormChoicesDisplay({
			holderId: 'vehicleCCMinSelection',
			insertEl: 'vehicleCCInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			holderId: 'vehicleCCMaxSelection',
			insertEl: 'vehicleCCInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleCCSecondMaxSelection',
			insertEl: 'vehicleCCSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: true,
			skipOddEvenCount: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleCCSecondMinSelection',
			insertEl: 'vehicleCCSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: true
		});
		this.vehicleCCField = new kpVehicleCCSearchField();
		this.fields['vehicle_cc'] = this.vehicleCCField;

		createFormChoicesDisplay({
			holderId: 'vehicleKMMinSelection',
			insertEl: 'vehicleKMInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			holderId: 'vehicleKMMaxSelection',
			insertEl: 'vehicleKMInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleKMSecondMaxSelection',
			insertEl: 'vehicleKMSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: false,
			skipOddEvenCount: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleKMSecondMinSelection',
			insertEl: 'vehicleKMSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: false
		});
		this.vehicleKMField = new kpVehicleKMSearchField();
		this.fields['vehicle_km'] = this.vehicleKMField;

		createFormChoicesDisplay({
			holderId: 'carBodyTypeSelection',
			insertEl: 'carBodyTypeInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carBodyTypeSecondSelection',
			insertEl: 'carBodyTypeSecondInsertSpot',
			insertPosition: 'after'
		});
		this.carBodyTypeField = new kpCarBodyTypeSearchField();
		this.fields['car_body_type'] = this.carBodyTypeField;

		createFormChoicesDisplay({
			holderId: 'carFuelTypeSelection',
			insertEl: 'carFuelTypeInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carFuelTypeSecondSelection',
			insertEl: 'carFuelTypeSecondInsertSpot',
			insertPosition: 'after'
		});
		this.carFuelTypeField = new kpCarFuelTypeSearchField();
		this.fields['car_fuel_type'] = this.carFuelTypeField;

		createFormChoicesDisplay({
			holderId: 'vehicleMakeYearMinSelection',
			insertEl: 'vehicleMakeYearInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			holderId: 'vehicleMakeYearMaxSelection',
			insertEl: 'vehicleMakeYearInsertSpot',
			insertPosition: 'bottom'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleMakeYearSecondMaxSelection',
			insertEl: 'vehicleMakeYearSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: false,
			skipOddEvenCount: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'vehicleMakeYearSecondMinSelection',
			insertEl: 'vehicleMakeYearSecondInsertSpot',
			insertPosition: 'after',
			keepHidden: false
		});
		this.vehicleMakeYearField = new kpVehicleMakeYearSearchField();
		this.fields['vehicle_make_year'] = this.vehicleMakeYearField;

		createFormChoicesDisplay({
			holderId: 'carAirconditionSelection',
			insertEl: 'carAirconditionInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carAirconditionSecondSelection',
			insertEl: 'carAirconditionSecondInsertSpot',
			insertPosition: 'after'
		});
		this.carAirconditionField = new kpCarAirconditionSearchField();
		this.fields['vehicle_aircondition'] = this.carAirconditionField;

		createFormChoicesDisplay({
			holderId: 'carDoorsSelection',
			insertEl: 'carDoorsInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carDoorsSecondSelection',
			insertEl: 'carDoorsSecondInsertSpot',
			insertPosition: 'after'
		});
		this.carDoorsField = new kpCarDoorsSearchField();
		this.fields['car_doors'] = this.carDoorsField;

		createFormChoicesDisplay({
			holderId: 'carGearboxSelection',
			insertEl: 'carGearboxInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carGearboxSecondSelection',
			insertEl: 'carGearboxSecondInsertSpot',
			insertPosition: 'after'
		});
		this.carGearboxField = new kpCarGearboxSearchField();
		this.fields['car_gearbox'] = this.carGearboxField;

		createFormChoicesDisplay({
			holderId: 'categorySelection',
			insertEl: 'categoryInsertSpot',
			insertPosition: 'top'
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'categorySecondSelection',
			insertEl: 'categorySecondInsertSpot',
			insertPosition: 'after'
		});
		this.categoryField = new kpCategorySearchField({
			adKindField: this.adKindField,
			recentValues: recentlyUsedValues && recentlyUsedValues['category_id'] ? recentlyUsedValues['category_id'] : []
		});
		this.fields['category'] = this.categoryField;
		this.categoryField.observe('changed', function(evt) {
			if (evt['memo'] && evt['memo']['source'] == 'user' && evt['memo']['fieldDisplayNum'] == 2) {	
				var cid = _this.categoryField.getKey();
				if (cid) {
					var catUrl = _this.categoryField.fieldValuesSource.getValueAttribute(cid,'url');
					if (catUrl && catUrl > '') {
						window.location = catUrl;
					}
				}
			}
		});

		createFormChoicesDisplay({
			holderId: 'groupSelection',
			insertEl: 'categorySelection',
			insertPosition: 'after',
			keepHidden: true
		});
		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'groupSecondSelection',
			insertEl: 'categorySecondSelection',
			insertPosition: 'after',
			keepHidden: true,
			skipOddEvenCount: true
		});
		this.groupField = new kpGroupSearchField({
			categoryObj: this.categoryField,
			recentValues: recentlyUsedValues && recentlyUsedValues['group_id'] ? recentlyUsedValues['group_id'] : []
		});
		this.fields['group'] = this.groupField;
		
		this.carModelField.setGroupObj(this.groupField);
	},
	initObservers: function() {
		var _this = this;

		try {
			this.formHolder.select('[action-name=form-reset]').each(function(el) {
				el.observe('click',function(evt) {
					_this.resetFields();
				})
			});
		} catch(e) {}

		try {
			this.formHolder.select('[action-name=form-open]').each(function(el) {
				el.observe('click',function(evt) {
					_this.open();
				})
			});
		} catch(e) {}

		try {
			this.formHolder.select('[action-name=form-close]').each(function(el) {
				el.observe('click',function(evt) {
					_this.close();
				})
			});
		} catch(e) {}

		/*document.observe('choiceDisplay:changed',function(evt) {
			_this.updateChoiceOddEven('searchFormDisplayChoicesHolder');
		});*/

		this.categoryField.observe('changed',function(evt) {
			this.updateFormHolderClasses();
		}.bind(this));

		this.groupField.observe('changed',function(evt) {
			var _this = this;
			var models = this.carModelField.getKeys();
			var gids = this.groupField.getKeys();
			
			// Change search form action, if URL available
			$('searchForm').action = 'search.php';
			if (gids > '') {
				var grpUrl = this.groupField.fieldValuesSource.getValueAttribute(gids, 'url');
				if (grpUrl > '') {
					$('searchForm').action = grpUrl;
				}
			}

			if (evt && evt['memo'] && evt['memo']['source'] == 'user') {
				var successCallbackFunc = function () {
					_this.carModelField.fieldDisplay.open();
					_this.groupField.close();
				};
			}

			if (gids.length > 0) {
				this.carModelField.fieldDisplay.show();
				this.carModelField.fieldSecondDisplay.show();
				this.carModelField.fieldValuesSource.setParam('group_id',gids.join(','));
				this.carModelField.fieldValuesSource.update({
					successCallback: successCallbackFunc
				});
			} else {
				this.carModelField.fieldDisplay.hide();
				this.carModelField.fieldSecondDisplay.hide();
				this.carModelField.removeAllValues();
				this.carModelField.fieldValuesSource.setParam('group_id','');
				this.carModelField.fieldValuesSource.update();
			}

			this.updateFormHolderClasses();
		}.bind(this));

		this.locationField.observe('changed',function(ev) {
			var lids = _this.locationField.getKeys();
			if (lids.size() > 0) {
				_this.locationRadiusField.show();
				_this.locationField.fieldDisplay.joinNext();
				_this.locationField.fieldSecondDisplay.joinNext();
			} else {
				_this.locationRadiusField.hide();
				_this.locationField.fieldDisplay.unjoinNext();
				_this.locationField.fieldSecondDisplay.unjoinNext();
			}
		});
	},
	open: function() {
		try {
			this.formHolder.addClassName('form-opened');
			this.formHolder.removeClassName('form-closed');
		} catch(e) {}
	},
	close: function() {
		try {
			this.formHolder.removeClassName('form-opened');
			this.formHolder.addClassName('form-closed');
		} catch(e) {}
	},
	updateChoiceOddEven: function(holderEl) {
		var num = 0;
		return;
		$(holderEl).select('.choice').each(function(el) {
			if (el.visible()) {
				if (el.readAttribute('skip-odd-even-count') != 'yes') {
					num++;
				}

				if (num % 2 == 0) {
					el.removeClassName('odd');
					el.addClassName('even');
				} else {
					el.removeClassName('even');
					el.addClassName('odd');
				}
			}
		});
	},
	getCategoryId: function() {
		var returnValue = 0;
		try {
			returnValue = this.categoryField.getKey();
		} catch(e) {}
		return returnValue;
	},
	setCategoryId: function(categoryId) {
		this.categoryField.addValue(categoryId);
	},
	getGroupId: function() {
		var returnValue = 0;
		try {
			returnValue = this.groupField.getKey();
		} catch(e) {}
		return returnValue;
	},
	setGroupId: function(groupId, params) {
		var params = params || {};
		
		if (params['url']) {
			this.form.action = params['url'];
		}
		
		if (params['categoryId']) {
			this.setCategoryId(params['categoryId']);
		}
		
		this.groupField.addValue(groupId, params['name']);
	},
	setAdType: function(adType) {
		if (adType === false) {
			this.adTypeField.removeAllValues();
		} else if (adType != undefined) {
			this.adTypeField.addValue(adType);
		}
	},
	submit: function() {
		this.form.submit();
	},
	getAdClass: function() {
		var returnValue = 'basic';
		//var grEl = $('data[group_id]');
		try {
			var groupId = this.getGroupId();
			if (groupId > '' && groupId > 0) {
				returnValue = this.groupField.fieldValuesSource.getValueAttribute(groupId,'ad_class');
			} else {
				var categoryId = this.getCategoryId();
				if (categoryId > '' && categoryId > 0) {
					returnValue = this.categoryField.fieldValuesSource.getValueAttribute(categoryId,'ad_class');
				}
			}
		} catch(e) {}

		returnValue = returnValue && returnValue > '' ? returnValue : 'basic';

		return returnValue;
	},
	updateFormHolderClasses: function() {
		var adClassValue = this.getAdClass();

		this.formHolder.removeClassName('ad-class-basic');
		this.formHolder.removeClassName('ad-class-car');

		if (adClassValue == 'car') {
			carSearchObj.initCarSection();
		}

		this.formHolder.addClassName('ad-class-'+adClassValue);
		document.fire('adclass:changed',{'adClassValue': adClassValue});
	},
	resetFields: function() {
		var fields = $H(this.fields);
		fields.each(function(el) {
			if (el['value'] && el['value'].removeAllValues) el['value'].removeAllValues();
		})
	},
	onSearchFiltersOutsideClick : function(ev) {
		if ( Event.findElement( ev,'#searchFormHolder' ) == undefined && Event.findElement( ev,'.choiceOptionClose' ) == undefined ) {
			this.close();
		}
	},
});

var kpAdKindSearchField = Class.create(kpFormSelectFieldArraySource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: [
				{key: 'all', value: 'Stvari i usluge'},
				{key: 'goods', value: 'Stvari'},
				{key: 'service', value: 'Usluge'}
			],
			holderEl: 'adKindSelection',
			//secondHolderEl: 'adKindSecondSelection',
			multiselect: false,
			defaultLabel: 'Stvari i usluge',
			notEmptyLabel: '',
			/*defaultKey: 'all',
			defaultValue: 'Stvari i usluge',*/
			emptySelectionDisabled: false,
			enableKeywordSearch: false,
			columns: 1,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || [],
			storageInputId: 'data[ad_kind]'
		});

		this.observe('changed',function(evt) {
			var memo = {};
			memo['adKind'] = _this.getKey();
			document.fire('adkind:changed',memo);
		});
	}
});

var kpAdTypeSearchField = Class.create(kpFormSelectFieldArraySource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: [
				{key: 'all', value: 'Nudi se/Traži se'},
				{key: 'sell', value: 'Nudi se'},
				{key: 'buy', value: 'Traži se'}
			],
			holderEl: 'adTypeSelection',
			secondHolderEl: 'adTypeSecondSelection',
			multiselect: false,
			notEmptyLabel: '',
			defaultLabel: 'Nudi se/Traži se',
			/*defaultKey: 'all',
			defaultValue: 'Nudi se/Traži se',*/
			emptySelectionDisabled: false,
			enableKeywordSearch: false,
			secondHideWhenEmpty: true,
			columns: 1,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || [],
			storageInputId: 'data[ad_type]',
			autocompleteEventKeyParam: 'ad_type'
		});
	}
});

var kpPriceSearchField = Class.create(kpFormSelectField, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'priceDisplay',
			notEmptyLabel: 'Cena/Zamena',
			multiselect: true
		});

		if ($('priceSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'priceSecondSelection',
				defaultLabel: 'Cena/Zamena',
				notEmptyLabel: 'Cena/Zamena',
				multiselect: true,
				hideWhenEmpty: false
			});
		}

		this.fieldValuesSelection = new kpFormPriceSearchSelection({
			parentEl: 'priceSelection'
		});

		this.fieldValuesSelection.setValues({
			dummy: false,
			price_min: this.options['price_min'] || '',
			price_max: this.options['price_max'] || '',
			currency: this.options['currency'] || '',
			has_price: this.options['has_price'] || '',
			auction: this.options['auction'] || '',
			exchange: this.options['exchange'] || '',
			price_text: this.options['price_text']
		});

		this.fieldValueStorage = null;

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: true
		});

		this.fieldDisplay.observe('choice:remove',function(evt) {
			_this.resetSelectionOnChoiceRemove(evt['memo']['key'])
		});
		if (this.fieldSecondDisplay) {
			this.fieldSecondDisplay.observe('choice:remove',function(evt) {
				_this.resetSelectionOnChoiceRemove(evt['memo']['key'])
			});
		}

	},
	resetSelectionOnChoiceRemove: function(key) {
		if (key == '1') {
			this.fieldValuesSelection.resetPriceFilters();
		} else if (key == 'auction') {
			this.fieldValuesSelection.resetAuctionFilter();
		} else if (key == 'exchange') {
			this.fieldValuesSelection.resetExchangeFilter();
		}
	}
});

var kpCategorySearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;

		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_categories&data[active]=yes,view',
			keyName: 'category_id',
			valueName: 'name',
			initialValues: (searchFieldInitialValues && searchFieldInitialValues['category_id']) ? searchFieldInitialValues['category_id'] : false
		});
		
		try {	
			if (this.options['adKindField']) {
				var adKind = this.options['adKindField'].getKey();
				if (adKind) {	
					this.fieldValuesSource.setParam('data[ad_kind]',adKind);
				}
			}
		} catch(e) {}
		
		this.fieldValuesSource.update();

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'categorySelection',
			multiselect: false,
			defaultLabel: 'Kategorija',
			notEmptyLabel: false,
			defaultKey: 'all',
			defaultValue: '',
			emptySelectionDisabled: false,
		});

		if ($('categorySecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'categorySecondSelection',
				multiselect: false,
				hideWhenEmpty: false,
				defaultLabel: 'Kategorija',
				notEmptyLabel: false,
				defaultKey: 'all',
				defaultValue: '',
				emptySelectionDisabled: false,
			});
		}

		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 4,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || []
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[category_id]'
		});

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			autocompleteEventKeyParam: 'category_id',
			multiselect: false
		});

		document.observe('adkind:changed',function(evt) {
			if (evt['memo'] && evt['memo']['adKind']) {
				var adKindType = evt['memo']['adKind'].split(':');
				if (adKindType[0] && adKindType[0] != 'all') {
					_this.fieldValuesSource.setParam('data[ad_kind]',adKindType[0]);
				} else {
					_this.fieldValuesSource.setParam('data[ad_kind]','');
				}
				_this.fieldValuesSource.update();
			}
		});
	},
	lateValueUpdate: function($super, key, value) { // When source has loaded values
		$super(key, value);
		this.fire('changed');
	},
	addInitialValue1: function(key, value) {
		var value = value || ' ';
		this._addValue(key, value);
	}
});

var kpGroupSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;

		this.categoryObj = options['categoryObj'];

		this.fieldValuesSource = new kpGroupsValuesSource({
			url: 'ajax_functions.php?action=get_groups&data[category_type]=all&data[active]=yes,view',
			keyName: 'category_id',
			valueName: 'name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['group_id'] ? searchFieldInitialValues['group_id'] : false
		});

		var categorySelected = false;
		if (this.categoryObj && this.categoryObj.getKey) {
			var currentCID = this.categoryObj.getKeys();
			this.fieldValuesSource.setParam('category_id',currentCID.join(','));
			categorySelected = currentCID.size() > 0;
		}

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'groupSelection',
			multiselect: false,
			defaultLabel: 'Grupa',
			notEmptyLabel: false,
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('groupSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'groupSecondSelection',
				multiselect: false,
				defaultLabel: 'Grupa',
				notEmptyLabel: false,
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}

		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 4,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || []
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[group_id]'
		});

		/*this.formField = new kpFormSelectField({
			fieldDisplay: this.fieldDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			multiselect: false,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || []
		});*/

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			autocompleteEventKeyParam: 'group_id',
			multiselect: false
		});
		
		/*
		this.groupTableList = new kpFormGroupTableSelection({
			holderEl: $('groupTableHolder'),
			//valuesSource: this.groupField.fieldValuesSource
			valuesSource: this.fieldValuesSource,
			categoryObj: this.categoryObj,
			groupObj: this
		});
		this.groupTableList.observe('item-click',function(evt) {
			if (evt['memo'] && evt['memo']['group_id']) {
				var groupId = evt['memo']['group_id'];
				//_this.groupField.addValue(groupId);
				_this.addValue(groupId);
			}			
		});
		//this.groupTableList.generateList();		
		*/
	 
		this.getInitialStorageValue();
		this.fieldValuesSource.update();
		this.updateGroupDisplay(categorySelected);

		this.observe('changed',function(evt) {
			var memo = {};
			memo['groupId'] = _this.getKey();
			memo['adClassValue'] = _this.fieldValuesSource.getValueAttribute(memo['groupId'],'ad_class');
			document.fire('group:changed',memo);
			
			//_this.groupTableList.showOrHide();
		});

		this.categoryObj.observe('changed',function(evt) {
			var grps = _this.getKeys();
			var cats = _this.categoryObj.getKeys();

			_this.updateGroupDisplay(cats.length > 0);
			
			//_this.groupTableList.showOrHide();

			if (evt && evt['memo'] && evt['memo']['source'] == 'user') {
				var successCallbackFunc = function () {

					if (evt['memo']['fieldDisplayNum'] > 0) {
						if (evt['memo']['fieldDisplayNum'] == 1) {
							_this.fieldDisplay.open()
						} else {
							//_this.fieldSecondDisplay.open()
						}
					} else {
						if (_this.valuesSelectionDisplayHolder && _this.valuesSelectionDisplayHolder.open)
							_this.valuesSelectionDisplayHolder.open();
						else
							_this.fieldDisplay.open();
					}
					_this.categoryObj.close();
				};
			}

			// Update group default label
			if (cats.join(',') == '1635') {
				_this.fieldDisplay.setDefaultLabel('Proizvođač');
				_this.fieldSecondDisplay.setDefaultLabel('Proizvođač');
			} else {
				_this.fieldDisplay.setDefaultLabel('Grupa');
				_this.fieldSecondDisplay.setDefaultLabel('Grupa');
			}

			_this.fieldValuesSource.setParam('category_id',cats.join(','));
			_this.fieldValuesSource.update({
				successCallback: successCallbackFunc
			});
		});
	},
	updateGroupDisplay: function(categorySelected) {
		var _this = this;
		try {
			if (!categorySelected) {
				_this.categoryObj.fieldDisplay.unjoinNext();
				if (_this.categoryObj.fieldSecondDisplay) {
					_this.categoryObj.fieldSecondDisplay.unjoinNext()
				}

				_this.fieldDisplay.unjoinPrev();
				_this.fieldDisplay.hide();
				if (_this.fieldSecondDisplay) {
					_this.fieldSecondDisplay.unjoinPrev()
					_this.fieldSecondDisplay.hide();
				}
			} else {
				_this.categoryObj.fieldDisplay.joinNext();
				if (_this.categoryObj.fieldSecondDisplay) {
					_this.categoryObj.fieldSecondDisplay.joinNext()
				}

				_this.fieldDisplay.joinPrev();
				_this.fieldDisplay.show();
				if (_this.fieldSecondDisplay) {
					_this.fieldSecondDisplay.joinPrev()
					_this.fieldSecondDisplay.show();
				}
			}
		} catch(e) {}
	},
	lateValueUpdate: function($super, key, value) { // When source has loaded values
		this.fire('changed');
		this._addValue(key, value);
	},
	getInitialStorageValue1: function($super) {
		$super();
	},
	addInitialValue1: function(key, value) {
		var value = value || ' ';
		this._addValue(key, value); // add directly without waiting for Ajax
	}
});

var kpLocationSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;

		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_locations',
			keyName: 'location_id',
			valueName: 'name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['location_id'] ? searchFieldInitialValues['location_id'] : false
		});
		this.fieldValuesSource.update();

		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'locationSelection',
			multiselect: false,
			defaultLabel: 'Mesto/Grad',
			notEmptyLabel: false
			/*
			emptySelectionDisabled: true,
			defaultKey: 'all',
			defaultValue: 'Sva mesta'*/
		});

		if ($('locationSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'locationSecondSelection',
				multiselect: false,
				hideWhenEmpty: false,
				defaultLabel: 'Mesto/Grad',
				notEmptyLabel: false
				/*
				emptySelectionDisabled: true,
				defaultKey: 'all',
				defaultValue: 'Sva mesta'*/
			});
		}

		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 5,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || []
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[location_id]'
		});

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: false
		});

	}
});

var kpLocationRadiusSearchField = Class.create(kpFormSelectFieldHashSource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: {
				'0': '0km',
				'10': 'do 10km',
				'25': 'do 25km',
				'50': 'do 50km',
				'75': 'do 75km',
				'100': 'do 100km',
				'150': 'do 150km',
				'200': 'do 200km',
				'250': 'do 250km',
				'300': 'do 300km'
			},
			holderEl: 'locationRadiusSelection',
			secondHolderEl: 'locationRadiusSecondSelection',
			multiselect: false,
			defaultLabel: 'Okolina',
			notEmptyLabel: 'Okolina',
			defaultKey: '0',
			defaultValue: '0km',
			emptySelectionDisabled: true,
			columns: 1,
			storageInputId: 'data[location_radius]',
			secondDisplayHideWhenEmpty: false
		});

		this.fieldDisplay.joinPrev();
		this.fieldSecondDisplay.joinPrev();
	}
});

var kpConditionSearchField = Class.create(kpFormSelectFieldHashSource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: {
				//'all': 'Bilo koje',
				'new': 'Novo',
				'as-new': 'Kao novo (nekorišćeno)',
				'used': 'Polovno',
				'damaged': 'Oštećeno ili neispravno'
			},
			holderEl: 'conditionSelection',
			secondHolderEl: 'conditionSecondSelection',
			multiselect: true,
			notEmptyLabel: 'Stanje',
			defaultLabel: 'Bilo koje stanje',
			defaultKey: false,
			defaultValue: 'Bilo koje stanje',
			emptySelectionDisabled: false,
			columns: 1,
			storageInputId: 'data[condition]',
			secondDisplayHideWhenEmpty: true
		});
	}
});

var kpPhotoSearchField = Class.create(kpFormSelectFieldHashSource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: {
				'yes': 'Ima slike'
			},
			holderEl: 'photoSelection',
			secondHolderEl: 'photoSecondSelection',
			multiselect: false,
			notEmptyLabel: 'Slika',
			defaultLabel: 'Sa i bez slika',
			defaultKey: false,
			emptySelectionDisabled: false,
			columns: 1,
			storageInputId: 'data[has_photo]'
		});
	}
});

var kpPeriodSearchField = Class.create(kpFormSelectFieldHashSource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: {
				'today': 'Današnji oglasi',
				'3day': 'Poslednja 3 dana',
				'7day': 'Poslednjih 7 dana'
			},
			holderEl: 'periodSelection',
			secondHolderEl: 'periodSecondSelection',
			multiselect: false,
			defaultLabel: 'Period',
			notEmptyLabel: 'Period',
			columns: 1,
			storageInputId: 'data[period]',
			secondDisplayHideWhenEmpty: true
		});
	}
});

var kpOrderSearchField = Class.create(kpFormSelectFieldHashSource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;
		if (false && this.options['newestFirst']) {
			var values = {
				'price': 'Jeftinije',
				'price desc': 'Skuplje',
				'newest': 'Novije oglase',
				'view_count desc': 'Popularnije'
			};			
		} else {
			var values = {
				'price': 'Jeftinije',
				'price desc': 'Skuplje',
				'posted desc': 'Novije oglase',
				'view_count desc': 'Popularnije'
			};			
		}
		if (this.options['hasKeywords']) values['relevance'] = 'Relevantnije';

		$super({
			values: values,
			holderEl: 'orderSelection',
			secondHolderEl: 'orderSecondSelection',
			multiselect: false,
			defaultLabel: 'Prikaži prvo',
			notEmptyLabel: 'Prvo',
			/*defaultKey: 'posted desc',
			defaultValue: 'Novije oglase',
			emptySelectionDisabled: true,*/
			columns: 1,
			storageInputId: 'data[order]'
		});
		
		if (this.getKey() == 'newest') {
			this.addValue('posted desc');
		}
	}
});


var kpCarSearch = Class.create({

	initialize : function(options) {
		this.options = options || {};
	
		this.form = $(this.options['formEl']);
		this.formHolder = $(this.options['formHolderEl']);
		this.adClassGetFunction = this.options['adClassGetFunction'];
		this.adClassValue = false;
		
		this.initObservers();
		this.initCarSection();
	},
	initObservers: function() {
		var _this = this;
		
		document.observe('group:changed1',function(evt) {
			var memo = evt['memo'];
			var adClassValue = false;
			if (memo) {
				adClassValue = memo['adClassValue'];
			}
			_this.setAdClass(adClassValue);
			_this.updateFormHolderClasses();
		});
	},
	initCarSection: function() {	
		
	},
	setAdClass: function(adClassValue) {
		this.adClassValue = adClassValue;
	},
	updateFormHolderClasses: function(adClassValue) {
		var adClassValue = adClassValue || this.adClassValue || 'basic';

		this.formHolder.removeClassName('ad-class-basic');
		this.formHolder.removeClassName('ad-class-car');
		
		if (adClassValue == 'car') {
			this.initCarSection();
		}
		
		this.formHolder.addClassName('ad-class-'+adClassValue);
		document.fire('adclass:changed',{'adClassValue': adClassValue});
	}	
});

kpCarMakeModelSearchField = Class.create({
	initialize: function(options) {
		this.options = options || {};
		
		this.makeFields = {};
		
		var _this = this;
		
		this.initNewMakeField();
	},
	initNewMakeField: function() {
		
		return;
		
		var _this = this;
		
		createFormChoicesDisplay({
			holderId: 'carNewMakeSelection',
			insertEl: 'carNewMakeInsertSpot',
			insertPosition: 'top'
		});

		createFormChoicesDisplay({
			templateEl: 'choiceListSecondDisplayTemplate',
			holderId: 'carNewMakeSeconSelection',
			insertEl: 'carMakeModelSecondInsertSpot',
			insertPosition: 'top'
		});

		this.makeValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_car_makes',
			keyName: 'car_make_id',
			valueName: 'make_name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['car_make'] ? searchFieldInitialValues['car_make'] : false
		});
		
		this.newMakeFieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carNewMakeSelection',
			multiselect: true,
			notEmptyLabel: 'Proizvođač(i)',
			defaultLabel: 'Proizvođač(i)',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});
		//this.newMakeFieldDisplay.clearfix();

		this.newMakeFieldSecondDisplay = new kpFormChoicesDisplay({
			holderEl: 'carNewMakeSeconSelection',
			multiselect: true,
			notEmptyLabel: 'Proizvođač(i)',
			defaultLabel: 'Proizvođač(i)',
			hideWhenEmpty: true,
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});
		
		this.newMakeFieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 5
		});
		
		this.newMakeValuesStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_make]'
		});
		
		this.newMakeField = new kpFormSelectFieldAjaxSource({
			fieldDisplay: this.newMakeFieldDisplay,
			fieldSecondDisplay: this.newMakeFieldSecondDisplay,
			fieldValuesSelection: this.newMakeFieldValuesSelection,
			fieldValuesSource: this.makeValuesSource,
			fieldValueStorage: this.newMakeValuesStorage,
			autocompleteEventKeyParam: 'car_make',
			multiselect: true,
			beforeAddChoice: function(key, value, params) {
				_this.addModelField(key);
				//_this.newMakeField.fieldDisplay.close();
				return false;
			},
			beforeRemoveChoice: function(key, params) {
				_this.removeModelField(key);
				return false;
			}
		});
		
		this.makeValuesSource.update();
		
		this.modelValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_model]'
		});
	},
	addModelField: function(makeId) {
		var _this = this;
		
		if (makeId) {
			if (!this.makeFields[makeId]) {

				this.makeFields[makeId] = {};
				
				/*
				var holderId = 'carMake'+makeId+'Selection';
				createFormChoicesDisplay({
					holderId: holderId,
					insertEl: 'carNewMakeInsertSpot',
					insertPosition: 'bottom'
				});
		
				var makeFieldDisplay = new kpFormChoicesDisplay({
					holderEl: holderId,
					multiselect: false,
					notEmptyLabel: '',
					defaultLabel: 'Proizvođač',
					defaultKey: makeId,
					defaultValue: this.makeValuesSource.getValue(makeId),
					emptySelectionDisabled: true
				});
				makeFieldDisplay.joinNext();
				
				var makeField = new kpFormSelectFieldAjaxSource({
					fieldDisplay: makeFieldDisplay,
					fieldValuesSelection: false,
					fieldValuesSource: this.makeValuesSource,
					multiselect: false,
					beforeAddChoice: function(key, value, params) {
						return true;
					},
					beforeRemoveChoice: function(key, params) {
						return true;
					}
				});
				*/
			 
				var makeName = this.makeValuesSource.getValue(makeId);
			 
				var modelHolderId = 'carModel'+makeId+'Selection';
				var modelSecondHolderId = 'carModel'+makeId+'SecondSelection';

				createFormChoicesDisplay({
					holderId: modelHolderId,
					insertEl: 'carNewMakeInsertSpot',
					insertPosition: 'bottom'
				});

				createFormChoicesDisplay({
					templateEl: 'choiceListSecondDisplayTemplate',
					holderId: modelSecondHolderId,
					insertEl: 'carMakeModelsSecondInsertSpot',
					insertPosition: 'before'
				});

				var modelFieldDisplay = new kpFormChoicesDisplay({
					holderEl: modelHolderId,
					multiselect: true,
					notEmptyLabel: makeName+' modeli',
					defaultLabel: makeName+' modeli',
					defaultKey: false,
					defaultValue: false,
					emptySelectionDisabled: false
				});
				//modelFieldDisplay.joinPrev();
				//modelFieldDisplay.clearfix();
				modelFieldDisplay.addClassName('space-after');

				var modelFieldSecondDisplay = new kpFormChoicesDisplay({
					holderEl: modelSecondHolderId,
					multiselect: true,
					notEmptyLabel: makeName+' modeli',
					defaultLabel: makeName+' modeli',
					defaultKey: false,
					defaultValue: false,
					emptySelectionDisabled: false
				});
				
				var modelValuesSource = new kpChoiceValuesSourceArrayAjax({
					url: 'ajax_functions.php?action=get_car_models&car_make_id='+makeId,
					keyName: 'car_model_id',
					valueName: 'model_name',
					initialValues: searchFieldInitialValues && searchFieldInitialValues['car_model'] ? searchFieldInitialValues['car_model'] : false
				});
				
				var modelValuesSelection = new kpFormValueSelection({
					enableKeywordSearch: true,
					columns: 5,
					limitMenuGroupsHolderHeight: 250
				});
		
				var modelField = new kpFormSelectFieldAjaxSource({
					fieldDisplay: modelFieldDisplay,
					fieldSecondDisplay: modelFieldSecondDisplay,
					fieldValuesSelection: modelValuesSelection,
					fieldValuesSource: modelValuesSource,
					multiselect: true
				});
				modelValuesSource.update();

				//modelFieldDisplay.open();
				
				this.makeFields[makeId] = {
					/*'holderId': holderId,
					'field': makeField,*/
					'modelHolderId': modelHolderId,
					'modelSecondHolderId': modelSecondHolderId,
					'modelField': modelField
				};
				
				modelField.observe('changed',function(evt) {
					_this.updateSelectedModels();
				});
				
			}			
		}
	},
	removeModelField: function(makeId) {
		var makeObj = this.makeFields[makeId];
		
		makeObj['modelField'].remove();
		
		this.makeFields[makeId] = false;
	},
	updateSelectedModels: function() {
		var _this = this;
		var modelIds = $A([]);
		var makeIds = Object.keys(this.makeFields);
		makeIds.each(function(makeId) {
			var mIds = _this.makeFields[makeId]['modelField'].getKeys();
			if (mIds && mIds.size() > 0) {
				modelIds = modelIds.concat(mIds);
			}
		});
		
		this.modelValueStorage.set(modelIds.join(','));
	}
});

var kpCarMakeSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_car_makes',
			keyName: 'car_make_id',
			valueName: 'make_name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['car_make'] ? searchFieldInitialValues['car_make'] : false
		});
		//this.fieldValuesSource.update();
		
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carMakeSelection',
			multiselect: true,
			notEmptyLabel: 'Proizvođač',
			defaultLabel: 'Proizvođač',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carMakeSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carMakeSecondSelection',
				multiselect: true,
				hideWhenEmpty: true,
				notEmptyLabel: 'Proizvođač',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 5
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_make]'
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			autocompleteEventKeyParam: 'car_make',
			multiselect: true
		});
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				_this.fieldValuesSource.update();
			}
		});
	},
	addInitialValue1: function(key, value) {
		var value = value || ' ';
		this._addValue(key, value);
	}
});

var kpCarModelSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_car_models',
			keyName: 'car_model_id',
			valueName: 'model_name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['car_model'] ? searchFieldInitialValues['car_model'] : false
		});
		//this.fieldValuesSource.update();

		this.carMakeObj = options['carMakeObj'];
		this.groupObj = false;
		if (options['groupObj']) this.setGroupObj(options['groupObj']);
		
		/*var makeSelected = false;
		if (this.carMakeObj && this.carMakeObj.getKey) {
			var currentMKID = this.carMakeObj.getKeys();
			this.fieldValuesSource.setParam('car_make_id',currentMKID.join(','));
			makeSelected = currentMKID.size() > 0;
		}*/
		
		var groupSelected = false;		
		
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carModelSelection',
			multiselect: true,
			notEmptyLabel: 'Model',
			defaultLabel: 'Model',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carModelSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carModelSecondSelection',
				multiselect: true,
				hideWhenEmpty: false,
				defaultLabel: 'Model',
				notEmptyLabel: 'Model',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: true,
			columns: 5,
			limitMenuGroupsHolderHeight: 250,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || []			
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_model]'
		});

		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			autocompleteEventKeyParam: 'car_model',
			multiselect: true
		});
		
		this.getInitialStorageValue();
		if (groupSelected) {
			this.fieldDisplay.show();
			this.fieldSecondDisplay.show();
			//this.fieldValuesSource.update();
		}
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				_this.fieldValuesSource.update();
			}
		});
		
		/*this.carMakeObj.observe('changed',function(evt) {
			var models = _this.getKeys();
			var makes = _this.carMakeObj.getKeys();
			
			if (evt && evt['memo'] && evt['memo']['source'] == 'user') {
				var successCallbackFunc = function () {
					_this.fieldDisplay.open();
					_this.carMakeObj.close();
				};
			}
			
			if (makes.length > 0) {
				_this.fieldDisplay.show();
			} else {
				_this.fieldDisplay.hide();
			}
			
			_this.fieldValuesSource.setParam('car_make_id',makes.join(','));
			_this.fieldValuesSource.update({
				successCallback: successCallbackFunc
			});
		});*/
		
		/*
		this.groupObj.observe('changed',function(evt) {
			var models = _this.getKeys();
			var gids = _this.groupObj.getKeys();
			
			if (evt && evt['memo'] && evt['memo']['source'] == 'user') {
				var successCallbackFunc = function () {
					_this.fieldDisplay.open();
					_this.groupObj.close();
				};
			}
			
			if (gids.length > 0) {
				_this.fieldDisplay.show();
			} else {
				_this.fieldDisplay.hide();
			}
			
			_this.fieldValuesSource.setParam('group_id',gids.join(','));
			_this.fieldValuesSource.update({
				successCallback: successCallbackFunc
			});
		});
		*/
	},
	setGroupObj: function(groupObj) {
		this.groupObj = groupObj;
		if (this.groupObj && this.groupObj.getKey) {
			var currentGID = this.groupObj.getKeys();
			this.fieldValuesSource.setParam('group_id',currentGID.join(','));
			groupSelected = currentGID.size() > 0;
		}
	},
	getInitialStorageValue1: function($super) {
		$super();
	},
	addInitialValue1: function(key, value) {
		var value = value || ' ';
		this._addValue(key, value); // add directly without waiting for Ajax
	}
});

var kpVehiclePowerSearchField = Class.create(kpFormRangeSelectField, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		this.values = {
			'25': '25KS (18kW)',
			'50': '50KS (37kW)',
			'75': '75KS (59kW)',
			'100': '100KS (74kW)',
			'125': '125KS (93kW)',
			'150': '150KS (112kW)',
			'200': '200KS (149kW)',
			'250': '250KS (186kW)',
			'300': '300KS (223kW)'
		};
		
		$super({
			values: this.values,
			multiselect: false,
			minHolderEl: 'vehiclePowerMinSelection',
			secondMinHolderEl: 'vehiclePowerSecondMinSelection',
			minDefaultLabel: 'KS od',
			minNotEmptyLabel: 'od',
			minStorageInputId: 'data[vehicle_power_min]',
			maxHolderEl: 'vehiclePowerMaxSelection',
			secondMaxHolderEl: 'vehiclePowerSecondMaxSelection',
			maxDefaultLabel: 'KS do',
			maxNotEmptyLabel: 'do',
			maxStorageInputId: 'data[vehicle_power_max]',
			columns: 1,
			secondDisplayHolderId: $('vehiclePowerSecondSelection') ? 'vehiclePowerSecondSelection' : false 
		});		
	}
});

var kpVehicleCCSearchField = Class.create(kpFormRangeSelectField, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		this.values = {
			'500': '500 cm3',
			'1150': '1150 cm3',
			'1300': '1300 cm3',
			'1600': '1600 cm3',
			'1800': '1800 cm3',
			'2000': '2000 cm3',
			'2500': '2500 cm3',
			'3000': '3000 cm3',
			'3500': '3500 cm3',
			'4500': '4500 cm3'
		};

		$super({
			values: this.values,
			multiselect: false,
			minHolderEl: 'vehicleCCMinSelection',
			secondMinHolderEl: 'vehicleCCSecondMinSelection',
			minDefaultLabel: 'cm3 od',
			minNotEmptyLabel: 'cm3 od',
			minStorageInputId: 'data[vehicle_cc_min]',
			maxHolderEl: 'vehicleCCMaxSelection',
			secondMaxHolderEl: 'vehicleCCSecondMaxSelection',
			maxDefaultLabel: 'cm3 do',
			maxNotEmptyLabel: 'cm3 do',
			maxStorageInputId: 'data[vehicle_cc_max]',
			columns: 1,
			secondDisplayHolderId: $('vehicleCCSecondSelection') ? 'vehicleCCSecondSelection' : false
		});
	}
});

var kpVehicleKMSearchField = Class.create(kpFormRangeSelectField, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		this.values = {
			'25000': '25.000 km',
			'50000': '50.000 km',
			'75000': '75.000 km',
			'100000': '100.000 km',
			'125000': '125.000 km',
			'150000': '150.000 km',
			'175000': '175.000 km',
			'200000': '200.000 km',
			'250000': '250.000 km'
		};

		$super({
			values: this.values,
			multiselect: false,
			minHolderEl: 'vehicleKMMinSelection',
			secondMinHolderEl: 'vehicleKMSecondMinSelection',
			minDefaultLabel: 'km od',
			minNotEmptyLabel: 'km od',
			minStorageInputId: 'data[vehicle_km_min]',
			maxHolderEl: 'vehicleKMMaxSelection',
			secondMaxHolderEl: 'vehicleKMSecondMaxSelection',
			maxDefaultLabel: 'km do',
			maxNotEmptyLabel: 'km do',
			maxStorageInputId: 'data[vehicle_km_max]',
			columns: 1,
			secondDisplayHolderId: $('vehicleKMSecondSelection') ? 'vehicleKMSecondSelection' : false,
			secondDisplayHideWhenEmpty: true
		});
	}
});

var kpVehicleMakeYearSearchField = Class.create(kpFormRangeSelectField, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		this.values = {};
		var d = new Date();
		var year = parseInt(d.getFullYear());
		var i;
		for (i=year;i>=1930;i--) {
			this.values[''+i+'.'] = i+'.';
			if (i <= 1990) i -= 4;
		}
		this.values = $H(this.values);

		$super({
			values: this.values,
			multiselect: false,
			minHolderEl: 'vehicleMakeYearMinSelection',
			secondMinHolderEl: 'vehicleMakeYearSecondMinSelection',
			minDefaultLabel: 'God. od',
			minNotEmptyLabel: 'God. od',
			minStorageInputId: 'data[vehicle_make_year_min]',
			maxHolderEl: 'vehicleMakeYearMaxSelection',
			secondMaxHolderEl: 'vehicleMakeYearSecondMaxSelection',
			maxDefaultLabel: 'God. do',
			maxNotEmptyLabel: 'God. do',
			maxStorageInputId: 'data[vehicle_make_year_max]',
			columns: 5,
			secondDisplayHolderId: $('vehicleMakeYearSecondSelection') ? 'vehicleMakeYearSecondSelection' : false,
			secondDisplayHideWhenEmpty: false,
			enableKeywordSearch: true,
		});
	}
});

var kpCarBodyTypeSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_car_body_types',
			keyName: 'body_type_id',
			valueName: 'body_type_name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['car_body_type'] ? searchFieldInitialValues['car_body_type'] : false
		});
		//this.fieldValuesSource.update();
		
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carBodyTypeSelection',
			multiselect: true,
			notEmptyLabel: 'Karoserija',
			defaultLabel: 'Karoserija',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carBodyTypeSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carBodyTypeSecondSelection',
				multiselect: true,
				hideWhenEmpty: true,
				notEmptyLabel: 'Karoserija',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: false,
			columns: 1
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_body_type]'
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: true
		});
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				_this.fieldValuesSource.update();
			}
		});
		
	}
});

var kpCarFuelTypeSearchField = Class.create(kpFormSelectFieldAjaxSource, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArrayAjax({
			url: 'ajax_functions.php?action=get_car_fuel_types',
			keyName: 'fuel_type_id',
			valueName: 'fuel_type_name',
			initialValues: searchFieldInitialValues && searchFieldInitialValues['car_fuel_type'] ? searchFieldInitialValues['car_fuel_type'] : false
		});
		//this.fieldValuesSource.update();
		
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carFuelTypeSelection',
			multiselect: true,
			notEmptyLabel: 'Gorivo',
			defaultLabel: 'Gorivo',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carFuelTypeSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carFuelTypeSecondSelection',
				multiselect: true,
				hideWhenEmpty: true,
				notEmptyLabel: 'Gorivo',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: false,
			columns: 1
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_fuel_type]'
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: true
		});
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				_this.fieldValuesSource.update();
			}
		});
		
	}
});

var kpCarAirconditionSearchField = Class.create(kpFormSelectField, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArray({
			values: [
				{key: 'no', value: 'Nema klimu'},
				{key: 'yes', value: 'Ima klimu'},
				{key: 'manual', value: 'Manuelna klima'},
				{key: 'automatic', value: 'Automatska klima'}
			]
		});
	
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carAirconditionSelection',
			multiselect: false,
			notEmptyLabel: 'Klima',
			defaultLabel: 'Klima',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carAirconditionSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carAirconditionSecondSelection',
				multiselect: false,
				hideWhenEmpty: true,
				notEmptyLabel: 'Klima',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: false,
			columns: 1
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[vehicle_aircondition]'
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: false
		});
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				if (_this.fieldValuesSource && _this.fieldValuesSource.update) {
					_this.fieldValuesSource.update();
				}
			}
		});
		
	}
});

var kpCarDoorsSearchField = Class.create(kpFormSelectField, {

	initialize : function($super,options) {
		this.options = options || {};
		var _this = this;
		
		this.fieldValuesSource = new kpChoiceValuesSourceArray({
			values: [
				{key: '3', value: '2/3 vrata'},
				{key: '5', value: '4/5 vrata'}
			]
		});
	
		this.fieldDisplay = new kpFormChoicesDisplay({
			holderEl: 'carDoorsSelection',
			multiselect: false,
			notEmptyLabel: 'Vrata',
			defaultLabel: 'Vrata',
			defaultKey: '',
			defaultValue: '',
			emptySelectionDisabled: false
		});

		if ($('carDoorsSecondSelection')) {
			this.fieldSecondDisplay = new kpFormChoicesDisplay({
				holderEl: 'carDoorsSecondSelection',
				multiselect: false,
				hideWhenEmpty: true,
				notEmptyLabel: 'Vrata',
				defaultKey: '',
				defaultValue: '',
				emptySelectionDisabled: false
			});
		}
		
		this.fieldValuesSelection = new kpFormValueSelection({
			enableKeywordSearch: false,
			columns: 1
		});

		this.fieldValueStorage = new kpChoiceValuesStoreInputHidden({
			input: 'data[car_doors]'
		});
		
		$super({
			fieldDisplay: this.fieldDisplay,
			fieldSecondDisplay: this.fieldSecondDisplay,
			fieldValuesSelection: this.fieldValuesSelection,
			fieldValuesSource: this.fieldValuesSource,
			fieldValueStorage: this.fieldValueStorage,
			multiselect: false
		});
		
		document.observe('adclass:changed',function(evt) {
			var memo = evt['memo'];
			if (memo && memo['adClassValue'] && memo['adClassValue'] == 'car') {
				if (_this.fieldValuesSource && _this.fieldValuesSource.update) {
					_this.fieldValuesSource.update();
				}
			}
		});
		
	}
});

var kpCarGearboxSearchField = Class.create(kpFormSelectFieldArraySource, {
	initialize : function($super, options) {
		this.options = options || {};
		var _this = this;

		$super({
			values: [
				{key: 'manual:4', value: '4 brzine'},
				{key: 'manual:5', value: '5 brzina'},
				{key: 'manual:6', value: '6 brzina'},
				{key: 'manual:7', value: 'Više brzina'},
				{key: 'semiautomatic', value: 'Poluautomatski'},
				{key: 'automatic', value: 'Automatski'}
			],
			holderEl: 'carGearboxSelection',
			secondHolderEl: 'carGearboxSecondSelection',
			multiselect: true,
			notEmptyLabel: 'Menjač',
			defaultLabel: 'Menjač',
			emptySelectionDisabled: false,
			enableKeywordSearch: false,
			columns: 1,
			recentValuesMaxCount: 3,
			recentValues: this.options['recentValues'] || [],
			storageInputId: 'data[car_gearbox]'
		});		
	}
});

var searchRecent = Class.create({
	initialize: function(options) {
		this.options = options || {};

		this.currentEffect = null;
		this.currentEffectTS = null;
		this.mouseOutTS = null;
		this.parentHolderEl = $(this.options['parentHolderEl']);
		
		if (!this.parentHolderEl) return;

		this.currentFilterId = 0;

		document.observe('click', this.onSuggestListOutsideClick.bind(this));

		this.prepareElements();
	},
	prepareElements: function() {
		var _this = this;
		
		try {
			var toggleList = this.parentHolderEl.select('[action-name="recent-searches"]').first();
			var closeList = this.parentHolderEl.select('[action-name="close-searches"]').first();
			var recentSearchItems = this.parentHolderEl.select('[action-name="recent-search-item"]');

			recentSearchItems.each(function(li) {
				li.on("mouseenter", function(ev) {
					if (this.readAttribute('filter-id') != this.currentFilterId) {
						_this.stopCurrentScroll();
						var text = this.select('[action-name="item-scrollable-text"]').first();
						_this.scrollText(text, li);
					}
				});

				try {
					li.select('[action-name=remove-suggestion]').each(function(el) {
						el.observe('click', function(ev) {
							_this.removeRecentSearch(li.readAttribute('filter-id'), li);
						});
					})
				} catch(e) {}
			});

			toggleList.observe("click", function() {
				_this.toggleSuggestions();
			});

			closeList.observe("click", function() {
				_this.closeSuggestions();
			});
		} catch(e) {}
	},
	/**
	 *
	 */
	onSuggestListOutsideClick: function(ev) {
		if (
						(Event.findElement(ev, '#searchRecentList') == undefined)
						&& (Event.findElement(ev, '[action-name="recent-searches"]') == undefined)
						&& (Event.findElement(ev, '[action-name="remove-suggestion"]') == undefined)
						) {
			this.parentHolderEl.removeClassName('searchRecentOpen');
		}
	},
	/**
	 *
	 */
	toggleSuggestions: function() {
		if (this.parentHolderEl.hasClassName('searchRecentOpen')) {
			this.parentHolderEl.removeClassName('searchRecentOpen');
		}
		else {
			this.parentHolderEl.addClassName('searchRecentOpen');
		}
	},
	/**
	 *
	 */
	closeSuggestions: function() {
		this.parentHolderEl.removeClassName('searchRecentOpen');
	},
	/**
	 *
	 * @param el
	 */
	scrollText: function(el, parentEl) {
		var _this = this;
		var elWidth = el.getWidth();
		if (this.currentFilterId == el.readAttribute('filter-id')) {
			return;
		}

		if (elWidth > 603) {
			//this.stopCurrentScroll();
			parentEl.stopObserving('mouseleave');
			parentEl.on('mouseleave', function(ev) {
				if (this.readAttribute('filter-id') > '' && this.readAttribute('filter-id') == _this.currentFilterId) {
					_this.stopCurrentScroll();
					el.setStyle({marginLeft: '0px'});
					_this.mouseOutTS = function(el) {
					}.delay(0, el)
				}
			});
			//this.currentEffectTS = this.startTextScrollLeft.bind(this).delay(0.2, el, parentEl);
			this.startTextScrollLeft(el, parentEl);
		}
	},
	stopCurrentScroll: function() {
		if (this.currentEffect && this.currentEffect.cancel) {
			this.currentEffect.cancel(this.currentEffect);
			this.currentEffect = null;
		}
		if (this.currentEffectTS) {
			clearTimeout(this.currentEffectTS);
		}

		this.currentFilterId = 0;
	},
	startTextScrollLeft: function(el, parentEl) {
		var _this = this;
		var elWidth = el.getWidth();
		var negativeMarginLeft = (586 - elWidth) - 6; // (li width - el width) - li padding
		var dur = 1 + Math.round(-negativeMarginLeft / 110, 1);
		this.stopCurrentScroll();
		clearTimeout(this.mouseOutTS);
		this.currentFilterId = parentEl.readAttribute('filter-id');
		this.currentEffect = new Effect.Morph(el, {
			style: {
				marginLeft: negativeMarginLeft + 'px',
			},
			duration: dur,
			delay: 0.6,
			transition: Effect.Transitions.linear,
			afterFinish: function() {
				_this.currentEffectTS = function() {
					_this.startTextScrollRight(el, parentEl);
				}.delay(1);
			}
		});
	},
	startTextScrollRight: function(el, parentEl) {
		var _this = this;
		var elWidth = el.getWidth();
		var negativeMarginLeft = (586 - elWidth) - 6; // (li width - el width) - li padding
		var dur = 1 + Math.round(-negativeMarginLeft / 110, 1);
		this.stopCurrentScroll();
		this.currentFilterId = el.readAttribute('filter-id');
		this.currentEffect = new Effect.Morph(el, {
			style: {
				marginLeft: '0px',
			},
			duration: dur,
			delay: 0.1,
			transition: Effect.Transitions.linear,
			afterFinish: function() {
				_this.currentEffectTS = function() {
					_this.startTextScrollLeft(el, parentEl);
				}.delay(1);
			}
		});
	},
	removeRecentSearch: function(filterId,el) {
		var cookies = new Cookies();

		var filterIds = cookies.get('recentFilterIds') || '';
		
		try {
			console.log(filterId);
			console.log(filterIds);
		} catch(e) {}

		var regexp = new RegExp(','+filterId+',',"g");
		//filterIds = filterIds.replace(regexp, ',rem'+filterId+',');
		filterIds = filterIds.replace(regexp, ',');

		var regexp = new RegExp('^'+filterId+',',"g");
		//filterIds = filterIds.replace(regexp, 'rem'+filterId+',');
		filterIds = filterIds.replace(regexp, ',');

		var regexp = new RegExp(','+filterId+'$',"g");
		//filterIds = filterIds.replace(regexp, ',rem'+filterId);
		filterIds = filterIds.replace(regexp, ',');

		var regexp = new RegExp('^'+filterId+'$',"g");
		//filterIds = filterIds.replace(regexp, 'rem'+filterId);
		filterIds = filterIds.replace(regexp, '');

		var regexp = new RegExp('^,',"g");
		filterIds = filterIds.replace(regexp, '');

		var regexp = new RegExp(',$',"g");
		filterIds = filterIds.replace(regexp, '');

		var regexp = new RegExp('^,$',"g");
		filterIds = filterIds.replace(regexp, '');
		
		filterIds = (filterIds > '' ? filterIds+',' : '')+'rem'+filterId;

		cookies.set('recentFilterIds',filterIds);
		
		try {
			console.log(filterIds);
		} catch(e) {}

		try {
			if (el && el.remove)
				el.remove();
		} catch(e) {}
	}	
});