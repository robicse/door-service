<?php

use \App\Review;

if(! function_exists('average_vendor_rating')){
    function average_vendor_rating($vendor_id){
        $sumVendorReview = \App\Review::where('vendor_user_id', $vendor_id)->select(DB::raw('SUM(rating) as total_rating'),DB::raw('count(id) as total_user'))->first();
        return (float) $sumVendorReview->total_rating/$sumVendorReview->total_user;
    }
}

//image upload
if (! function_exists('imageUploadAndUpdate')) {
    function imageUploadAndUpdate($image, $path,$size,$prevImage) {

        $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
        $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        //delete old image.....
        if ($prevImage != 'default.png'){
            if (Storage::disk('public')->exists($path. $prevImage)) {
                Storage::disk('public')->delete($path. $prevImage);
            }
        }
        if ($size == 0){
            $proImage = Image::make($image)->save($image->getClientOriginalExtension());
        }else{
            $proImage = Image::make($image)->resize($size)->save($image->getClientOriginalExtension());
        }
        Storage::disk('public')->put($path . $imagename, $proImage);
        return $imagename;
    }
}

if(! function_exists('vendorRating')) {
    function vendorRating($id)
    {
        $user = \App\User::find($id);
        $fiveStarRev = Review::where('vendor_user_id', $user->id)->where('rating', 5)->where('status', 1)->sum('rating');
        $fourStarRev = Review::where('vendor_user_id', $user->id)->where('rating', 4)->where('status', 1)->sum('rating');
        $threeStarRev = Review::where('vendor_user_id', $user->id)->where('rating', 3)->where('status', 1)->sum('rating');
        $twoStarRev = Review::where('vendor_user_id', $user->id)->where('rating', 2)->where('status', 1)->sum('rating');
        $oneStarRev = Review::where('vendor_user_id', $user->id)->where('rating', 1)->where('status', 1)->sum('rating');
        $totalRating = Review::where('vendor_user_id', $user->id)->sum('rating');

        //dd($fiveStarRev);
        if ($totalRating > 0) {
            $rating = (5 * $fiveStarRev + 4 * $fourStarRev + 3 * $threeStarRev + 2 * $twoStarRev + 1 * $oneStarRev) / ($totalRating);
            $totalRatingCount = number_format((float)$rating, 1, '.', '');
        } else {
            $totalRatingCount = number_format((float)0, 1, '.', '');
        }
        if (!empty($totalRatingCount)) {
            return $totalRatingCount;
        } else {
            return 'Something went wrong!';
        }
    }
}
?>
