# Custom Laravel Form Request

Let's suppose that we got some data in json string and we cannot validate it with using simple FormRequest provided in Laravel. In this case it is necessary to parse data after validate it with Laravel Validator, so iur controller keeps redundant code and you already are not sutisfied with this code. How to solve the problem:
Use custom validator provided here!

# How to use:

Create FormRequest php artisan make:request SomeRequest.
Use code from this package into your class. Or put this class into your App\Http\Requests folder and extend you just created request from this custom request. So your code will look something like this:

namespace ...
use ...

class SomeValidator extends CustomFormRequestValidator
{
	//overwrite here rules and authorize..
}


In your controller, your code will look:

        $customRequest = SomeValidator::getInstance()
            ->addJsonData($someData)
            ->validate();


        if (!$customRequest->isValid())
            //do something...