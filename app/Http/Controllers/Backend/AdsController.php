<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\AdRepository;
use App\Repositories\ConditionRepository;
use App\Http\Requests\AdminAdUpdateRequest;

class AdsController extends Controller
{

    public function __construct(public AdRepository $adRepository, public ConditionRepository $conditionRepository) {}
    /**
     * Will return ads list
     */
    public function adListing(Request $request): View
    {
        return view('backend.modules.ads.ads.list', ['ads' => $this->adRepository->adLists($request)]);
    }
    /**
     * Will return featured ad listing
     */
    public function featuredAdListing(Request $request)
    {
        return view('backend.modules.ads.ads.featured', ['ads' => $this->adRepository->adLists($request, true)]);
    }
    /**
     * Will delete an ad
     */
    public function deleteAd(Request $request): RedirectResponse
    {
        $res = $this->adRepository->deleteAnAd($request['id']);
        if ($res) {
            toastNotification('success', 'Ad deleted successfully', 'Success');

            if ($request->has('is_featured') && $request['is_featured'] != null) {
                return to_route('classified.ads.list.featured');
            }
            return to_route('classified.ads.list');
        }

        toastNotification('error', 'Ad delete failed', 'Error');
        return redirect()->back();
    }
    /**
     * Will redirect edit page
     */
    public function editAd($id): View
    {
        $ad_details = $this->adRepository->adDetails($id);
        $conditions = $this->conditionRepository->allAdsCondition();

        return view('backend.modules.ads.ads.edit', [
            'ad_details' => $ad_details,
            'conditions' => $conditions
        ]);
    }
    /**
     * Will update ad
     * 
     */
    public function updateAd(AdminAdUpdateRequest $request)
    {
        $res = $this->adRepository->updateAd($request);

        if ($res) {
            toastNotification('success', 'Ad updated successfully', 'Success');
            return to_route('classified.ads.edit', ['id' => $request['id'], 'lang' => $request['lang']]);
        }

        toastNotification('error', 'Ad update failed', 'Error');
        return redirect()->back();
    }
}
