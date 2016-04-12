<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Main;
use App\User;
use App\Poruke;
use App\Donatori;
use App\Podrska;
use App\Updates;
use App\Komentari;
use App\Komentariobjava;
use App\Podesavanja;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
Use Log;
use Request;
use View;
use Session;

class KampanjaController extends Controller
{

    public function dash($slug)
    {
        $kampanja = Main::whereslug($slug)->first();
        $user = Auth::user();
        $updates = Updates::whereslug($slug)->get();
        $donatora = Donatori::whereslug($slug)->count();
        $prikupljeno = Donatori::whereslug($slug)->sum('iznos');
        $podrska = Podrska::whereslug($slug)->count();
        
        $now = time(); // or your date as well
        $your_date = strtotime($kampanja->datumisteka);
        $datediff = $your_date - $now;
        $ostalodana = floor($datediff / (60 * 60 * 24));
        
        $kampanje = Main::whereobjavio($user->fullname)->get();
        $brojneprocitanih = Poruke::where(

        function ($query) {
            
            $query->where('receiver', '=', Auth::user()->id)->

            orWhere('sender', '=', Auth::user()->id);
        })->

        where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
            ->orderBy('id', 'DESC')
            ->count();
        
        return view("users.kampanja-edit", compact('kampanja', 'kampanje', 'user', 'donatora', 'prikupljeno', 'ostalodana', 'podrska', 'brojneprocitanih', 'updates'));
    }

    public function podesavanja($slug)
    {
        $kampanja = Main::whereslug($slug)->first();
        $user = Auth::user();
        $podesavanja = Podesavanja::wherekampanja_id($kampanja->id)->first();
        
        $kampanje = Main::whereobjavio($user->fullname)->get();
        $brojneprocitanih = Poruke::where(

        function ($query) {
            
            $query->where('receiver', '=', Auth::user()->id)->

            orWhere('sender', '=', Auth::user()->id);
        })->

        where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
            ->orderBy('id', 'DESC')
            ->count();
        return view("users.kampanja-podesavanja", compact('kampanja', 'kampanje', 'user', 'brojneprocitanih', 'podesavanja'));
    }

    public function sredstva($slug)
    {
        $kampanja = Main::whereslug($slug)->first();
        $user = Auth::user();
        
        $kampanje = Main::whereobjavio($user->fullname)->get();
        return view("users.kampanja-sredstva", compact('kampanja', 'kampanje', 'user'));
    }

    public function pageview($slug)
    {
        $user = Auth::user();
        $project = Main::whereslug($slug)->first();
        $objavio = User::wherefullname($project->objavio)->first();
        $updates = Updates::whereslug($slug)->orderBy('id', 'DESC')->get();
        $last_update = Updates::whereslug($slug)->orderBy('id', 'DESC')->first();
        $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)->paginate(10);
        $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        $podrska = Podrska::whereslug($slug)->orderBy('id', 'ASC')->get();
        $count = Komentari::whereslug($slug)->count();
        $podrska1 = json_encode($podrska);
        $kampanja = $project;
        $kampanje = Main::whereobjavio($user->fullname)->get();
        $brojneprocitanih = Poruke::where(

        function ($query) {
            
            $query->where('receiver', '=', Auth::user()->id)->

            orWhere('sender', '=', Auth::user()->id);
        })->

        where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
            ->orderBy('id', 'DESC')
            ->count();
        return view('users.page-view', compact('kampanja', 'project', 'updates', 'last_update', 'count', 'komentari', 'donatori', 'podrska', 'kampanje', 'user', 'objavio', 'brojneprocitanih'));
    }

    public function pageedit($slug)
    {
        $user = Auth::user();
        $project = Main::whereslug($slug)->first();
        $updates = Updates::whereslug($slug)->orderBy('datum', 'DESC')->get();
        $last_update = Updates::whereslug($slug)->first();
        $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)->paginate(10);
        $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        $podrska = Podrska::whereslug($slug)->get();
        $count = Komentari::whereslug($slug)->count();
        $podrska1 = json_encode($podrska);
        $kampanja = $project;
        $kampanje = Main::whereobjavio($user->fullname)->get();
        $brojneprocitanih = Poruke::where(

        function ($query) {
            
            $query->where('receiver', '=', Auth::user()->id)->

            orWhere('sender', '=', Auth::user()->id);
        })->

        where('readunread', 'NOT LIKE', '%' . Auth::user()->email . '%')
            ->orderBy('id', 'DESC')
            ->count();
        return view('users.page-edit', compact('kampanja', 'project', 'updates', 'last_update', 'count', 'komentari', 'donatori', 'podrska', 'kampanje', 'user', 'brojneprocitanih'));
    }

    public function pagesnimi($slug)
    {
        
        // $input = Input::all();
        /*
         * Input::get('naslov');
         * Input::get('lokacija');
         * Input::get('cilj');
         * Input::get('kategorija');
         * Input::get('datumisteka');
         * Input::get('text');
         * Input::get('slika');
         * Input::get('file1');
         * Input::get('file2');
         * Input::get('video');
         * Input::get('opsirnije');
         * Input::get('boja');
         * Input::get('pozadina');
         * Input::get('logo');
         */
        $fajlovi = array(
            "slika",
            "slika2",
            "slika3"
        );
        
        $slika[0] = $this->fetch('slika');
        $slika[1] = $this->fetch('slika2');
        $slika[2] = $this->fetch('slika3');
        $slika[3] = $this->fetch('slika4');
        $slika[4] = $this->fetch('slika5');
        $slika[5] = $this->fetch('slika6');
        $video = $this->fetch('video');
        
        $array = array(
            'naslov' => Input::get('naslov'),
            'cilj' => Input::get('cilj'),
            'kategorija' => Input::get('kategorija'),
            'skupljeno' => Input::get('skupljeno'),
            'lokacija' => Input::get('lokacija'),
            'datumisteka' => Input::get('datumisteka'),
            'text' => Input::get('text'),
            'opsirnije' => Input::get('opsirnije'),
            'boja' => Input::get('boja'),
            'pozadina' => Input::get('pozadina')
        );
        
        Log::info($video);
        // Log::info($slika[0]); Log::info($slika[1]); Log::info($slika[2]);
        if (! empty($slika[0]))
            $array['slika'] = $slika[0];
        if (! empty($slika[1]))
            $array['slika2'] = $slika[1];
        if (! empty($slika[2]))
            $array['slika3'] = $slika[2];
        
        if (! empty($slika[3]))
            $array['slika4'] = $slika[3];
        if (! empty($slika[4]))
            $array['slika5'] = $slika[4];
        if (! empty($slika[5]))
            $array['slika6'] = $slika[5];
        
        if (! empty($video))
            $array['videourl'] = $video;
            // if(!empty(Input::get('video'))) $array['videourl']=Input::get('video');
            // if(!empty(Input::get('videoslika'))) $array['video']=Input::get('videoslika');
            // if(!empty(Input::file('video'))) $array['videourl']=Input::get('video');
            
        // var_dump($array);
        Main::whereslug($slug)->update($array);
        
        return Redirect::to('/page-view/' . $slug);
    }

    public function update($slug)
    {
        $today = date("j, n, Y");
        $naslov = "Ažuriranje " . $today;
        $slika = $this->fetch('slika');
        Log::info($today);
        Log::info($naslov);
        $array = array(
            'slug' => $slug,
            'naslov' => $naslov,
            'update' => Input::get('update'),
            'avatar' => Auth::user()->slika,
            'user_id' => Auth::user()->id,
            'datum' => date("Y-m-d"),
            'slika' => $slika
        );
        
        Updates::insert($array);
        return Redirect::to('/page-view/' . $slug);
    }

    public function fetch($value)
    {
        $target_dir = "slike/";
        if ($_FILES[$value]["name"] == "") {
            
            return 0;
        }
        
        $target_file = $target_dir . basename($_FILES[$value]["name"]);
        Log::info($target_file);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $mime = mime_content_type($_FILES[$value]["tmp_name"]);
            if (strstr($mime, "video/")) {
                $uploadOk = 2;
            } else 
                if (strstr($mime, "image/")) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            
            /*
             * // $check = getimagesize($_FILES[$value]["tmp_name"]);
             * if($check !== false) {
             * echo "File is an image - " . $check["mime"] . ".";
             * $uploadOk = 1;
             * } else {
             * echo "Fajl nije slika!\n";
             * $uploadOk = 0;
             * }
             */
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            // echo "Sorry, file already exists.\n";
            return URL::to('/') . '/slike/' . basename($_FILES[$value]["name"]);
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES[$value]["size"] > 18000000) {
            echo "Fajl je prevelike velicine, smanjite kvalitet pa probajte opet.\n";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "3gp" && $imageFileType != "avi") {
            // echo "Samo slike sa JPG, JPEG, PNG & GIF ekstenzijama su dozvoljene.\n";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Jedan od fajlova nije uploadovan.\n";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$value]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES[$value]["name"]). " has been uploaded.";
                
                Log::info($target_file);
                $lokac = '../public/slike/' . basename($_FILES[$value]["name"]);
                if ($uploadOk == 1) {
                    $this->resizeImage($lokac, $lokac, 600, 400);
                }
                return URL::to('/') . '/slike/' . basename($_FILES[$value]["name"]);
            } else {
                echo "Greska u slanju slike.\n";
                Log::info("greska");
            }
        }
    }

    public function uplatesnimi()
    {
        Main::whereid(Input::get('id'))->update([
            'uputstvo' => Input::get('text')
        ]);
        
        // return Redirect::back();
    }

    public function podrzi()
    {
        if (Auth::user()->grad != "" && Input::get('lat') != "") {
            $array = array(
                'slug' => Input::get('slug'),
                'ime_suportera' => Input::get('ime_suportera'),
                'grad' => Auth::user()->grad,
                'lat' => Input::get('lat'),
                'long' => Input::get('long'),
                'slika' => Input::get('slika')
            );
        } else {
            $array = array(
                'slug' => Input::get('slug'),
                'ime_suportera' => Input::get('ime_suportera'),
                'slika' => Input::get('slika')
            );
        }
        
        Podrska::insert($array);
    }

    static public function slugify($string, $delimiter = '-')
    {
        // Remove special characters
        $string = preg_replace("/[^\p{L}\/_|+ -]/ui", "", $string);
        
        // Replace blank space with delimeter
        $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
        
        // Trim delimiter
        $string = trim($string, $delimiter);
        
        return mb_strtolower($string);
    }

    public function pokreni()
    {
        $slug = $this->slugify(Input::get('naslov'));
        $cilj = preg_replace("/[^0-9]/", "", Input::get('cilj'));
        
        $array = array(
            'slug' => $slug,
            'naslov' => Input::get('naslov'),
            
            'cilj' => $cilj,
            'lokacija' => Input::get('lokacija'),
            'kategorija' => Input::get('kategorija'),
            'objavio' => Auth::user()->fullname
        );
        
        $getid = Main::insertGetId($array);
        Podesavanja::insert([
            "kampanja_id" => $getid
        ]);
        
        return Redirect::to('/page-edit/' . $slug);
    }

    public function objavi()
    {
        $array = array(
            'live' => 'da'
        );
        
        Main::whereid(Input::get('id'))->update($array);
    }

    public function pauziraj()
    {
        $array = array(
            'live' => 'ne'
        );
        
        Main::whereid(Input::get('id'))->update($array);
    }

    /**
     * Resize image - preserve ratio of width and height.
     *
     * @param string $sourceImage
     *            path to source JPEG image
     * @param string $targetImage
     *            path to final JPEG image file
     * @param int $maxWidth
     *            maximum width of final image (value 0 - width is optional)
     * @param int $maxHeight
     *            maximum height of final image (value 0 - height is optional)
     * @param int $quality
     *            quality of final image (0-100)
     * @return bool
     */
    function resize($newWidth, $targetFile, $originalFile)
    {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];
        
        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;
            
            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;
            
            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;
            
            default:
                throw new Exception('Unknown image type.');
        }
        
        $img = $image_create_func($originalFile);
        list ($width, $height) = getimagesize($originalFile);
        
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        $image_save_func($tmp, "$targetFile");
    }

    /**
     * Resize image - preserve ratio of width and height.
     *
     * @param string $sourceImage
     *            path to source JPEG image
     * @param string $targetImage
     *            path to final JPEG image file
     * @param int $maxWidth
     *            maximum width of final image (value 0 - width is optional)
     * @param int $maxHeight
     *            maximum height of final image (value 0 - height is optional)
     * @param int $quality
     *            quality of final image (0-100)
     * @return bool
     */
    function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 80)
    {
        // Obtain image from given source file.
        if (! $image = @imagecreatefromjpeg($sourceImage)) {
            return false;
        }
        
        // Get dimensions of source image.
        list ($origWidth, $origHeight) = getimagesize($sourceImage);
        
        if ($maxWidth == 0) {
            $maxWidth = $origWidth;
        }
        
        if ($maxHeight == 0) {
            $maxHeight = $origHeight;
        }
        
        // Calculate ratio of desired maximum sizes and original sizes.
        $widthRatio = $maxWidth / $origWidth;
        $heightRatio = $maxHeight / $origHeight;
        
        // Ratio used for calculating new image dimensions.
        $ratio = min($widthRatio, $heightRatio);
        
        // Calculate new image dimensions.
        $newWidth = (int) $origWidth * $ratio;
        $newHeight = (int) $origHeight * $ratio;
        
        // Create final image with new dimensions.
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
        imagejpeg($newImage, $targetImage, $quality);
        
        // Free up the memory.
        imagedestroy($image);
        imagedestroy($newImage);
        
        return true;
    }

    /**
     * Example
     * resizeImage('image.jpg', 'resized.jpg', 200, 200);
     */
    public function opcije()
    {
        $opcija = Input::get('opcija');
        $odabir = Input::get('odabir');
        
        Podesavanja::wherekampanja_id(Input::get('id'))->update([
            $opcija => $odabir
        ]);
    }

    public function updateizmenasnimi()
    {
        Updates::whereid(Input::get('id'))->update([
            'update' => Input::get('update')
        ]);
    }

    public function updatedelete()
    {
        Updates::whereid(Input::get('id'))->delete();
    }

    public function izbrisitag()
    {
        Main::whereid(Input::get('id'))->update([
            Input::get('imetaga') => ""
        ]);
    }

    public function kampanjabrisanje()
    {
        Main::whereid(Input::get('id'))->delete();
    }

    public function getlokacija()
    {
        $project = Main::whereid(Input::get('id'))->first();
        $podrska = Podrska::whereslug($project->slug)->get();
        if (Request::ajax()) {
            return \Response::json(View::make('kampanje.lokacija', array(
                'project' => $project,
                'podrska' => $podrska
            ))->render());
        }
    }

    public function getpocetna()
    {
        $project = Main::whereid(Input::get('id'))->first();
        $slug = $project->slug;
        $objavio = User::wherefullname($project->objavio)->first();
        $updates = Updates::whereslug($slug)->with('komentariobjava')
            ->orderBy('id', 'DESC')
            ->get();
        $last_update = Updates::whereslug($slug)->orderBy('id', 'desc')->first();
        $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)
            ->take(12)
            ->get();
        Session::set('loaded_komentari', 12);
        // $komentari_objave = Komentariobjava::with('updates')->orderBy('id', 'DESC')->whereslug($slug)->get();
        $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        $podrska = Podrska::whereslug($slug)->get();
        $count = Komentari::whereslug($slug)->count();
        $podrska1 = json_encode($podrska);
        
        if (Request::ajax()) {
            return \Response::json(View::make('kampanje.pocetna', array(
                'project' => $project,
                'last_update' => $last_update,
                'updates' => $updates,
                'komentari' => $komentari,
                'podrska' => $podrska
            ))->render());
        }
    }

    public function getnovosti()
    {
        $project = Main::whereid(Input::get('id'))->first();
        $slug = $project->slug;
        $objavio = User::wherefullname($project->objavio)->first();
        $updates = Updates::whereslug($slug)->with('komentariobjava')
            ->orderBy('id', 'DESC')
            ->get();
        // $last_update = Updates::whereslug($slug)->orderBy('id', 'desc')->first();
        // $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)->take(12)->get();
        // Session::set('loaded_komentari', 12);
        // $komentari_objave = Komentariobjava::with('updates')->orderBy('id', 'ASC')->whereslug($slug)->take(12)->get();
        // $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        // $podrska = Podrska::whereslug($slug)->get();
        // $count = Komentari::whereslug($slug)->count();
        // $podrska1 =json_encode( $podrska );
        
        if (Request::ajax()) {
            return \Response::json(View::make('kampanje.updates', array(
                'project' => $project,
                'updates' => $updates
            ))->render());
        }
    }

    public function getkomentari()
    {
        $project = Main::whereid(Input::get('id'))->first();
        $slug = $project->slug;
        $objavio = User::wherefullname($project->objavio)->first();
        // $updates = Updates::whereslug($slug)->with('komentariobjava')->orderBy('id', 'DESC')->get();
        // $last_update = Updates::whereslug($slug)->orderBy('id', 'desc')->first();
        $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)
            ->take(12)
            ->get();
        Session::set('loaded_komentari', 12);
        
        // $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        // $podrska = Podrska::whereslug($slug)->get();
        $count = Komentari::whereslug($slug)->count();
        // $podrska1 =json_encode( $podrska );
        
        if (Request::ajax()) {
            return \Response::json(View::make('kampanje.comments', array(
                'project' => $project,
                'komentari' => $komentari
            ))->render());
        }
    }

    public function getpodrzali()
    {
        $project = Main::whereid(Input::get('id'))->first();
        $slug = $project->slug;
        $objavio = User::wherefullname($project->objavio)->first();
        // $updates = Updates::whereslug($slug)->with('komentariobjava')->orderBy('id', 'DESC')->get();
        // $last_update = Updates::whereslug($slug)->orderBy('id', 'desc')->first();
        // $komentari = Komentari::orderBy('id', 'DESC')->whereslug($slug)->take(12)->get();
        // Session::set('loaded_komentari', 12);
        
        // $donatori = Donatori::orderBy('iznos', 'DESC')->whereslug($slug)->get();
        $podrska = Podrska::whereslug($slug)->orderBy('id', 'ASC')
            ->take(80)
            ->get();
        
        // $count = Komentari::whereslug($slug)->count();
        $podrska1 = json_encode($podrska);
        
        if (Request::ajax()) {
            return \Response::json(View::make('kampanje.podrzali', array(
                'project' => $project,
                'podrska' => $podrska
            ))->render());
        }
    }
}
