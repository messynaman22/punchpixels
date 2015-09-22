<?php namespace App\Services;

use App\ContractAgreementSection;
use Wpb\StringBladeCompiler\StringView;

class ContractAgreementService {

    /**
     * Get all contract agreement sections
     *
     * @param  array  $data
     * @return array
     */
    public function getAll(array $data)
    {
        $contractAgreementSections = ContractAgreementSection::all();
        $agreementSections = array();
        foreach ($contractAgreementSections as $contractAgreementSection)
        {
            $view = new StringView();
            $agreementSections[$contractAgreementSection['section_name']] =
            $content = $view->make(
                array(
                    'template'  => $contractAgreementSection['content'],
                    'cache_key' => $contractAgreementSection['section_name'].'_agreement',
                    'updated_at' => 0
                ),
                $data
            )->render();
            $agreementSections[$contractAgreementSection['section_name']] = $content;
        }
        return $agreementSections;
    }

}
