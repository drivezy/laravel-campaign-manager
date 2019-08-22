<?php

namespace Drivezy\LaravelCampaignManager\Libraries\Validations;

use Illuminate\Support\Str;

/**
 * Class ModelColumnCampaignValidation
 * @package Drivezy\LaravelCampaignManager\Libraries\Validations
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class ModelColumnCampaignValidation extends BaseCampaignValidation {

    /**
     * Sets operand for comparision.
     * Sets invalid if data is not provided in request.
     */
    protected function setOperand () {
        $modelName = Str::camel($this->validation->master->data_model->name);
        $columnName = $this->validation->master->column_detail->name;

        $this->operand = $this->request[ $modelName ]->$columnName ?? 'INVALID';
    }
}
