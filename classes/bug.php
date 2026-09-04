<?php

class Bug
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $language,
        public string $category,
        public string $difficulty,
        public string $cause,
        public string $solution,
        public string $lesson
    ) {
}
}