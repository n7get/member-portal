<?php

namespace App\Helpers;

class PreviousRoute
{
  public function __construct(
    private string $name,
    private int $id,
    private string $initialRoute
  ) {
  }

  public function getName(): string
  {
    return $this->name;
  }
  
  public function getId(): int
  {
    return $this->id;
  }
  
  public function getInitialRoute(): string
  {
    return $this->initialRoute;
  }
}
