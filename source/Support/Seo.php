<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo
{
    /** @var Optimizer */
    protected $optimizer;

    /**
     * Seo constructor.
     * @param string $schema
     */
    public function __construct(string $schema = "article")
    {
        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
            SITENAME,
            SITELANG,
            $schema
        )->twitterCard(
            TWITTER_CREATOR,
            TWITTER_PUBLISHER,
            DOMAIN
        )->publisher(
            FACEBOOK_PAGE,
            FACEBOOK_AUTHOR,
            GOOGLE_PAGE,
            GOOGLE_AUTHOR
        )->facebook(
            FACEBOOK_APP
        );
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->optimizer->data()->$name;
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param bool $follow
     * @return string
     */
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string
    {
        return $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }

    /**
     * @return Optimizer
     */
    public function optimizer(): Optimizer
    {
        return $this->optimizer;
    }

    /**
     * @param string|null $title
     * @param string|null $desc
     * @param string|null $url
     * @param string|null $image
     * @return null|object
     */
    public function data(?string $title = null, ?string $desc = null, ?string $url = null, ?string $image = null)
    {
        return $this->optimizer->data($title, $desc, $url, $image);
    }
}