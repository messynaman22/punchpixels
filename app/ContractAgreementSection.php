<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractAgreementSection extends Model
{
    protected $table = 'contract_agreement_section';
    public $timestamps = true;
    public $fillable = ['section_name', 'section_description', 'content'];
}
