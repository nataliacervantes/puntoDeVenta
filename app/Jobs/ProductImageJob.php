<?php

namespace App\Jobs;

use App\Models\ProductImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProductImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $image;
    protected $image2;
    protected $id;
    public function __construct($image,$image2,$id)
    {
        $this->image = $image;
        $this->image2 = $image2;
        $this->id = $id;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->image != null && $this->image2 != null){
            $contents = file_get_contents($this->image);
            $name = substr($this->image, strrpos($this->image, '/') + 1);
            Storage::put('public/'.$this->id.'/'.$name, $contents);

            ProductImage::create(['product_id'=>$this->id,'image'=>'storage/'.$this->id.'/'.$name]);
            
            $contents = file_get_contents($this->image2);
            $name = substr($this->image2, strrpos($this->image2, '/') + 1);
            Storage::put('public/'.$this->id.'/'.$name, $contents);

            ProductImage::create(['product_id'=>$this->id,'image'=>'storage/'.$this->id.'/'.$name]);
        }
        elseif($this->image != null){
            $contents = file_get_contents($this->image);
            $name = substr($this->image, strrpos($this->image, '/') + 1);
            Storage::put('public/'.$this->id.'/'.$name, $contents);

            ProductImage::create(['product_id'=>$this->id,'image'=>'storage/'.$this->id.'/'.$name]);
        }
        elseif($this->image2 != null){
            $contents = file_get_contents($this->image2);
            $name = substr($this->image2, strrpos($this->image2, '/') + 1);
            Storage::put('public/'.$this->id.'/'.$name, $contents);

            ProductImage::create(['product_id'=>$this->id,'image'=>'storage/'.$this->id.'/'.$name]);
        }

    }
}
