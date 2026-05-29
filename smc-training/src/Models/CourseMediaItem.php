<?php

namespace Training\Api\Models;

use Google\Cloud\Translate\V3\TranslationServiceClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Training\Api\Traits\HasAttachment;
use Training\Api\Traits\HasTranslatableAttachment;

class CourseMediaItem extends Model
{
    use HasFactory, SoftDeletes, HasAttachment, HasTranslatableAttachment;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(config('smc-training.models.course_media_item'), 'parent_id');
    }

    protected $with = ['attachment','children'];

    public function getTable()
    {
        return config('smc-training.table_names.course_media_items');
    }

    /**
     * @return \Training\Api\Models\Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }





    /**
     * @param $targetLanguage
     * @return void
     * @throws \Google\ApiCore\ApiException
     * @throws \Google\ApiCore\ValidationException
     */
    public function translateAttachment($targetLanguage)
    {
        //Get
        $attachment = $this->attachment;
        $ext = pathinfo($attachment->attachment_location, PATHINFO_EXTENSION);
        $newPath = 'translatedDocuments/'. $attachment->id .'-'.trim(strtolower($targetLanguage)).'.'.$ext;

        if(file_exists(storage_path('app/'.$newPath))) {
            //FILE CACHED
        } else {
            //Translate
            $path = storage_path('app/google/spring-cab-377313-5293968e24ad.json');
            abort_unless(file_exists($path), 500 , 'Google ApiKey JSON Missing');
            putenv("GOOGLE_APPLICATION_CREDENTIALS=". $path);
            $projectId = "spring-cab-377313";
            $translationClient = new \Google\Cloud\Translate\V3\TranslationServiceClient([
                'projectId' => $projectId,
            ]);

            //Translate document
            $config = new \Google\Cloud\Translate\V3\DocumentInputConfig([
                'content' => file_get_contents(storage_path('app/'.$attachment->attachment_location)),
                'mime_type' => $attachment->attachment_content_type
            ]);

            //View response
            $output = $translationClient->translateDocument(
                TranslationServiceClient::locationName($projectId, 'global'),
                $targetLanguage,
                $config
            );

            $raw = $output->getDocumentTranslation()->getByteStreamOutputs()[0];


            Storage::disk('local')->put($newPath, $raw);
        }

        return Attachment::create([
            'attacher_id' => $attachment,
            'attacher_type' => get_class($attachment),
            'attachment_content_type' => $attachment->attachment_content_type,
            'attachment_location' => $newPath,
            'attachment_file_name' => $attachment->attachment_file_name,
            'attachment_file_size' => $attachment->attachment_file_size,
        ]);
    }

}
