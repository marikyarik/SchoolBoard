<?php
namespace app\component;

class Template
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = rtrim($path, '/').'/';
    }

    /**
     * @throws \Exception
     */
    public function render(string $view, array $context = []): string
    {
        if (!file_exists($file = $this->path.$view)) {
            throw new \Exception(sprintf('The file %s could not be found.', $view));
        }

        extract(array_merge($context, ['template' => $this]));

        ob_start();

        include ($file);

        return ob_get_clean();
    }
}