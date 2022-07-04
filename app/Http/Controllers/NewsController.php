<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\EventContent;
use App\Models\EventDate;
use App\Models\News;
use App\Models\PartnershipWithParentQuestionAnswer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
//        $news = News::all();
        $news = EventContent::orderBy('position', 'asc')->get();
        return view('news.index')->with([
            'news' => $news
        ]);
    }

    public function create()
    {
        return view('news.add-news');
    }

    public function edit($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('news.edit-news')->with(['news' => $news]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $data = $request->all();
        $data['slug'] = Str::of($request->get('title'))->slug('-');
        $data['ref_id'] = News::generateRefId();
        if ($request->hasFile('thumb')) {
            $data['thumb'] = $request->file('thumb')->store('', 'images');
        }

        News::create($data);
        return redirect()->route('news');
    }

    public function update(Request $request, $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        foreach ($request->all() as $key => $param) {
            if (!!$param && $key !== '_token') {
                $news->{$key} = $param;
            }
        }
        $news->save();
        return redirect()->route('news');
    }

    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();
        return redirect()->route('news');
    }

    // School Calendar
    public function indexCalendar()
    {
        $event_dates = EventDate::all();
        return view('pages.school-calendar')->with([
            'event_dates' => $event_dates
        ]);
    }



    // Q/As
    public function indexQA()
    {
        $news = PartnershipWithParentQuestionAnswer::orderBy('position', 'asc')->get();
        return view('pages.questions-answers')->with([
            'news' => $news
        ]);
    }

    public function createQuestionAnswer()
    {
        return view('pages.create-questions-answers');
    }

    public function storeQA(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);
        $count = PartnershipWithParentQuestionAnswer::count();

        $data = $request->all();
        $data['position'] = $count + 1;

        PartnershipWithParentQuestionAnswer::create($data);
        return redirect()->route('questions-answer');
    }

    public function toggleDisplayQA($id)
    {
        $qa = PartnershipWithParentQuestionAnswer::findOrFail($id);
        if ($qa->status == 1)
            $qa->status = 0;
        elseif ($qa->status == 0)
            $qa->status = 1;
        $qa->save();
        return redirect()->route('questions-answer');
    }

    public function editQA($id)
    {
        $link = PartnershipWithParentQuestionAnswer::findOrFail($id);
        return view('pages.edit-questions-answers')->with([
            'page' => $link
        ]);
    }

    public function updateQA(Request $request)
    {
        $id = $request->page_id;
        $link = PartnershipWithParentQuestionAnswer::find($id);
        request()->request->remove('page_id');

        $link->title = $request->title;
        $link->content = $request->content;
        $link->position = $request->position;
        $link->status = $request->status;

        $link->save();
        return redirect()->route('questions-answer');
    }

    public function deleteQA($id)
    {
        $qa = PartnershipWithParentQuestionAnswer::findOrFail($id);
        $qa->delete();
        return redirect()->route('questions-answer');
    }

    public function uploadContent(Request $request)
    {
        $file = $request->file('calendar');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
//Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
//Where uploaded file will be stored on the server
            $location = 'uploads'; //Created an "uploads" folder for that
// Upload file
            $file->move($location, $filename);
// In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);
// Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
//Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
// Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;
//            dd($importData_arr);
            foreach ($importData_arr as $importData) {
                try{
                    $date = Carbon::createFromFormat('d/m/Y',$importData[1])->format('Y-m-d'); //Get dates
                }
                catch (Exception $exception){
                    $date = Carbon::now()->format('Y-m-d'); //Get dates
                }
                $event = $importData[2]; //Get the event
                $j++;
                try {
                    DB::beginTransaction();
                    EventDate::create([
                        'date' => $date,
                        'ceremony' => $event,
                    ]);
//Send Email
                    DB::commit();
                } catch (\Exception $e) {
//throw $th;
                    DB::rollBack();
                }
            }
            return redirect()->route('school-calendar');
        } else {
//no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx", "xls"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

//Clubs
    public function indexClubs()
    {
        $clubs = Club::query()->orderBy('category')->get();
        return view('pages.clubs')->with([
            'clubs' => $clubs
        ]);
    }

    public function createClub()
    {
        return view('pages.create-club');
    }

    public function storeClub(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'category' => ['required']
        ]);
        $data = $request->all();

        Club::create($data);
        return redirect()->route('school-clubs');
    }

    public function editClub($id)
    {
        $link = Club::findOrFail($id);
        return view('pages.edit-club')->with([
            'page' => $link
        ]);
    }

    public function updateClub(Request $request)
    {
        $id = $request->page_id;
        $link = Club::find($id);
        request()->request->remove('page_id');

        $link->name = $request->name;
        $link->category = $request->category;

        $link->save();
        return redirect()->route('school-clubs');
    }

    public function deleteClub($id)
    {
        $qa = Club::findOrFail($id);
        $qa->delete();
        return redirect()->route('school-clubs');
    }
}
