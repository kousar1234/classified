<?php

namespace App\View\Components;

use Closure;
use App\Models\Media as MediaModel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Media extends Component
{

    public $is_multiple = false;
    public $name;
    public $value;
    public $media_ids;
    public $width;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $value = null, $width = false, $is_multiple = false)
    {
        $this->is_multiple = $is_multiple;
        $this->name = $name;
        $this->value = $value;
        $this->width = $width;

        if ($is_multiple) {
            $this->media_ids = MediaModel::whereIn('path', $value)->pluck('id');
        }

        if (!$is_multiple) {
            $this->media_ids = MediaModel::where('path', $value)->take(1)->pluck('id');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('backend.media.media');
    }
}
