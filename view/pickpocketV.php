<?php

class pickpocketV extends view
{
  public function draw($data): void
  {
    echo json_encode($data);
  }
}
?>