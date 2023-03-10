<?php

namespace Woo\Slug\Listeners;

use Woo\Base\Events\CreatedContentEvent;
use Woo\Slug\Repositories\Interfaces\SlugInterface;
use Woo\Slug\Services\SlugService;
use Exception;
use Illuminate\Support\Str;
use SlugHelper;

class CreatedContentListener
{
    protected SlugInterface $slugRepository;

    public function __construct(SlugInterface $slugRepository)
    {
        $this->slugRepository = $slugRepository;
    }

    public function handle(CreatedContentEvent $event): void
    {
        if (SlugHelper::isSupportedModel(get_class($event->data)) && $event->request->input('is_slug_editable', 0)) {
            try {
                $slug = $event->request->input('slug');

                $fieldNameToGenerateSlug = SlugHelper::getColumnNameToGenerateSlug($event->data);

                if (! $slug) {
                    $slug = $event->request->input($fieldNameToGenerateSlug);
                }

                if (! $slug && $event->data->{$fieldNameToGenerateSlug}) {
                    if (! SlugHelper::turnOffAutomaticUrlTranslationIntoLatin()) {
                        $slug = Str::slug($event->data->{$fieldNameToGenerateSlug});
                    } else {
                        $slug = $event->data->{$fieldNameToGenerateSlug};
                    }
                }

                if (! $slug) {
                    $slug = time();
                }

                $slugService = new SlugService($this->slugRepository);

                $this->slugRepository->createOrUpdate([
                    'key' => $slugService->create($slug, (int)$event->data->slug_id, get_class($event->data)),
                    'reference_type' => get_class($event->data),
                    'reference_id' => $event->data->id,
                    'prefix' => SlugHelper::getPrefix(get_class($event->data)),
                ]);
            } catch (Exception $exception) {
                info($exception->getMessage());
            }
        }
    }
}
