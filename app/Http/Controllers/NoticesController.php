<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provider;
use App\Notice;

class NoticesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        $notices = $this->user->notices;

        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        // get list of providers
        $providers = Provider::lists('name', 'id');

        // load a view to create a new notice
        return view('notices.create', compact('providers'));
    }

    /**
     * [confirm description]
     * @param  Requests\PrepareNoticeRequest $request [description]
     * @return [type]                                 [description]
     */
    public function confirm(Requests\PrepareNoticeRequest $request)
    {
        
        $template = $this->compileDmcaTemplate($data = $request->all());

        session()->flash('dmca', $data);

        return view('notices.confirm', compact('template'));
    }

    /**
     * compiles the dmca notice from GET form submission
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function compileDmcaTemplate($data)
    {

        $data = $data + [

            'name' => $this->user->name,
            'email' => $this->user->email,
        ];

        return view()->file(app_path('Http/Templates/dmca.blade.php'), $data);
        

    }

    /**
     * Store a new DMCA notice
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $notice = $this->createNotice($request);

        //fire off the email
        \Mail::queue('emails.dmca', compact('notice'), function($message) use ($notice) {
            $message->from($notice->getOwnerEmail())
                    ->to($notice->getRecipientEmail())
                    ->subject('DMCA Notice');
        });

        flash('Your DMCA notice has been delivered');

        return redirect('notices');

    }

    /**
     * Update notice
     * @param  [type]  $noticeId [description]
     * @param  Request $request  [description]
     * @return [type]            [description]
     */
    public function update($noticeId, Request $request)
    {
        $isRemoved = $request->has('content_removed');

        Notice::findOrFail($noticeId)
            ->update(['content_removed' => $isRemoved]);
        
        
    }

    /**
     * Create and persist new DMCA notices
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createNotice(Request $request)
    {
        $notice = session()->get('dmca') + ['template' => $request->input('template')];

        $notice = $this->user->notices()->create($notice);

        return $notice;
    }

}
