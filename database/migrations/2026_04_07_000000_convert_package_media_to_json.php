<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert existing single values to JSON arrays
        $packages = DB::table('packages')->get();

        foreach ($packages as $package) {
            $imageUrls = $package->image_url ? json_encode([$package->image_url]) : json_encode([]);
            $imagePublicIds = $package->image_public_id ? json_encode([$package->image_public_id]) : json_encode([]);
            $videoUrls = $package->video_url ? json_encode([$package->video_url]) : json_encode([]);
            $videoPublicIds = $package->video_public_id ? json_encode([$package->video_public_id]) : json_encode([]);

            DB::table('packages')->where('id', $package->id)->update([
                'image_url' => $imageUrls,
                'image_public_id' => $imagePublicIds,
                'video_url' => $videoUrls,
                'video_public_id' => $videoPublicIds,
            ]);
        }

        Schema::table('packages', function (Blueprint $table) {
            $table->json('image_url')->nullable()->change();
            $table->json('image_public_id')->nullable()->change();
            $table->json('video_url')->nullable()->change();
            $table->json('video_public_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('image_url')->nullable()->change();
            $table->string('image_public_id')->nullable()->change();
            $table->string('video_url')->nullable()->change();
            $table->string('video_public_id')->nullable()->change();
        });

        // Convert JSON arrays back to single values
        $packages = DB::table('packages')->get();

        foreach ($packages as $package) {
            $imageUrls = json_decode($package->image_url, true);
            $imagePublicIds = json_decode($package->image_public_id, true);
            $videoUrls = json_decode($package->video_url, true);
            $videoPublicIds = json_decode($package->video_public_id, true);

            DB::table('packages')->where('id', $package->id)->update([
                'image_url' => $imageUrls[0] ?? null,
                'image_public_id' => $imagePublicIds[0] ?? null,
                'video_url' => $videoUrls[0] ?? null,
                'video_public_id' => $videoPublicIds[0] ?? null,
            ]);
        }
    }
};
