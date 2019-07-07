<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SomeValidator extends FormRequest
{
    /**
     * custom validator
     *
     * @var Validator
     */
    protected $validator;
    /**
     * keeps valid request status
     *
     * @var bool
     */
    protected $isValid;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort.highest_price' => 'required|boolean',
            //another rules..
        ];
    }
    /**
     * easy way to avoid (new Class())
     *
     * @return ValidateProductsFiltersBuyer
     */
    public static function getInstance()
    {
        return new self;
    }
    /**
     * add new validation data
     *
     * @param array $newData
     * @return $this
     */
    public function addData(array $newData)
    {
        $this->merge($newData);
        return $this;
    }
    /**
     * is data valid
     *
     * @return $this
     */
    public function validate()
    {
        $this->isValid = !Validator::make($this->all(), $this->rules())->fails();
        return $this;
    }
    /**
     * if request is valid
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }
    /**
     * parse json
     *
     * @param string $json
     * @return mixed
     */
    public function addJsonData(string $json)
    {
        return $this->addData(json_decode($json, true));
    }
}