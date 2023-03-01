<?php
class MFCR {
    private $api_endpoint;

    public function __construct() {
        // Endpoint z ktoreho ziskame data
        $this->api_endpoint = 'https://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=';
    }

    public function udaje_subjektu(string $ico) {
        // Ziskame data z endpointu
        $xml_data = file_get_contents($this->api_endpoint.$ico);

        // Nahradime znaky aby XML bol vo spravnom formate
        $xml_str = str_replace(PHP_EOL, '', $xml_data);

        // Nacitame XML do premenej
        $xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA);

        // Ziskame xml prefixy a zaregistrujeme ich ako XPath
        foreach ($xml->getDocNamespaces(true) as $prefix => $i) {
            $xml->registerXPathNamespace($prefix, $i);
        }

        // Ziskame udaje cez XPath
        $adresa = $xml->xpath('//D:AD/D:UC | //D:AD/D:PB');

        // Ak adresa je prazdna znamena to ze subjekt neexistuje
        if (!empty($adresa)) {
            $nazov = $xml->xpath('//D:VBAS/D:OF');
            $typ = $xml->xpath('//D:VBAS/D:PF/D:NPF');
            $zamestnanci = $xml->xpath('//D:VBAS/D:KPP');

            // Vytvorime objekt
            return (object) [
                'adresa' => $adresa[0] .', '. $adresa[1],
                'nazov' => (string)$nazov[0],
                'typ' => (string)$typ[0],
                'zamestnanci' => (string)$zamestnanci[0]
            ];
        } else {
            return false;
        }
    }
}

