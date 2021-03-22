<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Company;
use Image;

class CompanyJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        
        if(!empty($data['logo']))
        {
            $path = storage_path().'/app/public/';
            if(!file_exists($path))
            {
                mkdir($path,0777);
            }else{
                chmod($path,0777);
            }

            $image = $data['logo'];
            $image_name = time().'.jpg';
            $save_image = Image::make($image->getRealPath());
            $save_image->save($path.'/'.$image_name);
            chmod($path.'/'.$image_name,0777);

            $data['logo'] = $image_name;
        }
        
        $company_save = Company::firstOrNew(['id'=>$data['id']]);
        $company_save->fill($data);
        $company_save->save();

        return;
    }
}
