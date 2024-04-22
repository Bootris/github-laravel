<?php

namespace App\Http\Controllers;

use App\Exceptions\IncorrectProviderException;
use App\Services\GitHubPopularityService;
use App\Support\Enums\ProviderType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Construct the base controller class.
     */
    public function __construct(protected $providerService = null)
    {
        $this->__invoke();
    }

    /**
     * Invoke controller method.
     */
    public function __invoke(): void
    {
        switch (config('services.provider')) {
            case ProviderType::GITHUB:
                $this->providerService = new GitHubPopularityService();
                break;
            default:
                throw new IncorrectProviderException();
        }
    }
}
