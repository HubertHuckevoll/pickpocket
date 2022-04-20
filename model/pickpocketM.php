<?php

class pickpocketM extends model
{
  /**
   * fetchContent
   * ________________________________________________________________
   */
  public function fetchContent($url, $xpath)
  {
    //https://player.livespotting.com/jwp.html?alias=PS_f9931&ch=LS_3f855
    //https://hasenbuelt.synology.me/pickpocket/index.php?url=https://player.livespotting.com/jwp.html?alias=PS_f9931&ch=LS_3f855&xpath=//link[@rel=%27image_src%27]/@href
    //https://cdn.livespotting.com/vpu/4b7r3v86/xhn7c8l2.jpg
    $data = [];

    try
    {
      // load html
      $html = $this->grab($url);
      //logger::vh($html);

      // create Document
      $internalErrors = libxml_use_internal_errors(true);
      $doc = new DOMDocument();
      $doc->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG | LIBXML_NOXMLDECL);

      // fetch target nodes
      $xp = new DOMXPath($doc);

      $els = $xp->query($xpath);
      if (count($els) > 0)
      {
        foreach($els as $el)
        {
          $str = $el->nodeValue;
          $data[$xpath][] = $str;
        }
      }
    }
    catch(Exception $e)
    {
      $data['error'] = $e->getMessage();
    }

    return $data;
  }
}

?>