<?php

use App\Models\Page;
use App\Models\Media;
use App\Models\Setting;
use App\Models\Language;
use App\Models\PageContent;
use App\Models\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Cache;
use App\Models\PageContentTranslation;
use Illuminate\Support\Facades\Artisan;

if (! function_exists("saveFileInStorage")) {
    /**
     * upload file in storage
     * @param $file
     * @param $path
     * @return string
     */
    function saveFileInStorage($file)
    {
        $extension = $file->getClientOriginalExtension();
        $file_original_name = $file->getClientOriginalName();
        $file_name_array = explode('.', $file_original_name);
        $file_name_with_out_extension = $file_name_array[0];
        $file_size = $file->getSize();
        $disk = 'public';
        $destination_folder = "uploaded";
        $path = $file->store($destination_folder, $disk);

        $media = new Media();
        $media->title = $file_name_with_out_extension;
        $media->file_name = $file_original_name;
        $media->alt = $file_name_with_out_extension;
        $media->mime_type = $extension;
        $media->size = $file_size;
        $media->path = $path;
        $media->disk = $disk;
        $media->uploaded_by = auth()->user() != null ? auth()->user()->id : null;

        $media->save();

        return $media->path;
    }
}

if (!function_exists('theme')) {
    /**
     * Set toast message
     *
     * @param String $type
     * @param String $message
     * @param String $header
     * @return void
     */
    function theme($path)
    {
        return 'frontend' . "." . $path;
    }
}

if (!function_exists('toastNotification')) {
    /**
     * Set toast message
     *
     * @param String $type
     * @param String $message
     * @param String $header
     * @return void
     */
    function toastNotification($type, $message, $header = null)
    {
        Toastr::$type($message, $header);
    }
}

if (!function_exists('setEnv')) {
    /**
     * update env value
     * @param $name KeyName
     * @param $value Key Value
     * @return void
     */
    function setEnv($name, $value)
    {
        $value = trim($value);
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name),
                $name . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $settings = Cache::remember('settings', 86400, function () {
            return Setting::all();
        });
        $setting = $settings->where('key', $key)->first();

        return $setting == null ? $default : $setting->value;
    }
}

if (!function_exists('set_setting')) {
    function set_setting($key, $value = null)
    {
        try {
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->value = $value;
            $setting->save();
            cache()->forget('settings');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('getFilePath')) {
    function getFilePath(string|null $path, bool $placeholder = true, string|null $size = null): string
    {

        if ($placeholder && $path == null) {
            $location = getPlaceHolder();
            return $location;
        }

        if ($size != null) {
            $full_path_array = explode('/', $path);
            $file_full_name = $full_path_array[sizeof($full_path_array) - 1];
            $file_full_name_array = explode('.', $file_full_name);
            $file_name = sizeof($file_full_name_array) > 1 ? $file_full_name_array[0] : null;
            $extension = sizeof($file_full_name_array) > 1 ? $file_full_name_array[1] : null;
            $variant_image_name = $file_name . $size . '.' . $extension;
            array_pop($full_path_array);
            $location = implode('/', $full_path_array);
            $variant_image_path = $location . '/' . $variant_image_name;
            $full_path = 'public/' . $variant_image_path;
            if (file_exists($full_path)) {
                return $full_path;
            }
        }

        $location = 'public/' . $path;
        if (!file_exists($location)) {
            return getPlaceHolder();
        }

        return $location;
    }
}

if (!function_exists('getPlaceHolder')) {
    function getPlaceHolder()
    {
        return "/public/web-assets/backend/img/media/place_holder.jpg";
    }
}

if (!function_exists('translation')) {
    function translation($key, $lang = null, $addslashes = false)
    {
        return $key;
        if ($lang == null) {
            $lang = session()->get('locale');
        }

        $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

        $translations_en = Cache::rememberForever('translations-en', function () {
            return Translation::where('lang', 'en')->pluck('lang_value', 'lang_key')->toArray();
        });

        if (!isset($translations_en[$lang_key])) {
            $translation_def = new Translation;
            $translation_def->lang = 'en';
            $translation_def->lang_key = $lang_key;
            $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
            $translation_def->save();
            cache_clear();
        }

        // return user session lang
        $translation_locale = Cache::rememberForever("translations-{$lang}", function () use ($lang) {
            return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
        });

        if (isset($translation_locale[$lang_key])) {
            return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
        }

        // return default lang if session lang not found
        $translations_default = Cache::rememberForever('translations-' . env('DEFAULT_LANGUAGE', 'en'), function () {
            return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
        });

        if (isset($translations_default[$lang_key])) {
            return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
        }

        // fallback to en lang
        if (!isset($translations_en[$lang_key])) {
            return trim($key);
        }

        return $addslashes ? addslashes(trim($translations_en[$lang_key])) : trim($translations_en[$lang_key]);
    }
}

if (!function_exists('f_trans')) {
    function f_trans($key, $lang = null, $addslashes = false)
    {
        if ($lang == null) {
            $lang = session()->get('user-locale');
        }

        $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

        $translations_en = Cache::rememberForever('user-translations-en', function () {
            return Translation::where('lang', 'en')->pluck('lang_value', 'lang_key')->toArray();
        });

        if (!isset($translations_en[$lang_key])) {
            $translation_def = new Translation;
            $translation_def->lang = 'en';
            $translation_def->lang_key = $lang_key;
            $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
            $translation_def->save();
            cache_clear();
        }

        // return user session lang
        $translation_locale = Cache::rememberForever("user-translations-{$lang}", function () use ($lang) {
            return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
        });

        if (isset($translation_locale[$lang_key])) {
            return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
        }


        // return default lang if session lang not found
        $translations_default = Cache::rememberForever('user-translations-en', function () {
            return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
        });

        if (isset($translations_default[$lang_key])) {
            return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
        }

        // fallback to en lang
        if (!isset($translations_en[$lang_key])) {
            return trim($key);
        }

        return $addslashes ? addslashes(trim($translations_en[$lang_key])) : trim($translations_en[$lang_key]);
    }
}

if (!function_exists('cache_clear')) {
    /**
     * cache clear
     *
     * @return void
     */
    function cache_clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
    }
}


if (!function_exists('x_clean')) {
    function x_clean($text)
    {
        return clean($text, array('Attr.EnableID' => true));
    }
}

if (!function_exists('defaultLangCode')) {
    function defaultLangCode()
    {
        return 'en';
    }
}

if (!function_exists('getLocale')) {
    function getLocale()
    {
        return session()->get('locale') != null ? session()->get('locale') : defaultLangCode();
    }
}

if (!function_exists('getUserLocale')) {
    function getUserLocale()
    {
        return session()->get('user-locale') != null ? session()->get('user-locale') : defaultLangCode();
    }
}

if (!function_exists('activeLanguages')) {
    function activeLanguages()
    {
        return Language::where('status', config('settings.general_status.active'))->get();
    }
}

if (!function_exists('bodyDirection')) {
    function bodyDirection()
    {
        return session()->get('body-direction') != null ? session()->get('body-direction') : 'ltr';
    }
}


if (!function_exists('p_trans')) {
    function p_trans($key, $lang = null, $fallback = null)
    {

        if ($lang == null) {
            $lang = getUserLocale();
        }


        $page_content = PageContent::firstOrCreate([
            'key' => $key,
        ]);

        if ($lang == null || $lang == 'en') {
            return $page_content->value;
        } else {
            $page_content_translations = PageContentTranslation::where('lang', $lang)
                ->where('page_content_id', $page_content->id)
                ->first();
            return $page_content_translations != null ? $page_content_translations->value : $page_content->value;
        }

        return $fallback;
    }
}
