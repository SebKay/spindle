<?php

namespace App\Dependencies;

class View
{
    /**
     * @var \Twig\Loader\FilesystemLoader
     */
    protected $loader;

    /**
     * @var array
     */
    protected $twig_args = [];

    /**
     * @var \Twig\Environment
     */
    protected $twig;

    /**
     * Set up
     *
     * @param string $templates_path
     * @param string $cache_path
     */
    public function __construct(string $templates_path, string $cache_path = '')
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($templates_path);

        $this->twig_args['cache'] = ($cache_path != '' ? $cache_path : false);

        $this->twig = new \Twig\Environment($this->loader, $this->twig_args);
    }

    /**
     * Return a Twig template as a string
     *
     * @param string $name
     * @param array $args
     * @return string
     */
    public function render(string $name, array $args = []): string
    {
        return $this->twig->render($name, $args);
    }
}
