<?php
class MFCR {
    private $api_endpoint;

    public function __construct() {
        // Endpoint z ktorého získame data
        $this->api_endpoint = 'https://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=';
    }

    /**
     * Získanie informácie z českého registra firiem.
     *
     * @param string $ico IČO subjektu
     * @return object|false Ak IČO je platné a subjekt sa nachádza v registri, vráti objekt, ak nie vráti hodnotu false.
     */
    public function info_subjektu(string $ico) {
        // Získame dáta z endpointu
        $xml_data = file_get_contents($this->api_endpoint.$ico);

        // Nahradíme znaky, aby bolo XML vo správnom formáte
        $xml_str = str_replace(PHP_EOL, '', $xml_data);

        // Načítame XML do premennej
        $xml = simplexml_load_string($xml_str, 'SimpleXMLElement', LIBXML_NOCDATA);

        // Získame XML prefixy a zaregistrujeme ich ako XPath
        foreach ($xml->getDocNamespaces(true) as $prefix => $i) {
            $xml->registerXPathNamespace($prefix, $i);
        }

        // Získame údaje pomocou XPath
        $adresa = $xml->xpath('//D:AD/D:UC | //D:AD/D:PB');

        // Ak adresa je prázdna, znamená to že subjekt neexistuje
        if (!empty($adresa)) {
            $nazov = $xml->xpath('//D:VBAS/D:OF');
            $typ = $xml->xpath('//D:VBAS/D:PF/D:NPF');
            $zamestnanci = $xml->xpath('//D:VBAS/D:KPP');

            // Vytvoríme objekt
            return (object) [
                'adresa' => $adresa[0] .', '. $adresa[1],
                'nazov' => (string)$nazov[0],
                'typ' => (string)$typ[0],
                'zamestnanci' => (string)$zamestnanci[0]
            ];
        } else {
            // Ak subjekt neexistuje vrátime hodnotu false
            return false;
        }
    }
}

