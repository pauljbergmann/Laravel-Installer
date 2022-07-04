<?php

namespace Pauljbergmann\LaravelInstaller\Helpers;

use Illuminate\Contracts\Validation\Validator;

class Reply
{
    /**
     * Return a success response.
     *
     * @param $messageOrData
     * @param null $data
     * @return array
     */
    public static function success($messageOrData, $data = null): array
    {
        $response = ['status' => 'success'];

        if (! empty($messageOrData) && ! is_array($messageOrData)) {
            $response['message'] = Reply::getTranslated($messageOrData);
        }

        if (is_array($data)){
            $response = array_merge($data, $response);
        }

        if (is_array($messageOrData)) {
            $response = array_merge($messageOrData, $response);
        }

        return $response;
    }

    /**
     * Return error response
     *
     * @param string $message
     * @param string|null $errorName
     * @param array $errorData
     * @return array
     */
    public static function error(string $message, ?string $errorName = null, array $errorData = []): array
    {
        return [
            'status' => 'fail',
            'error_name' => $errorName,
            'data' => $errorData,
            'message' => Reply::getTranslated($message)
        ];
    }

    /**
     * Return validation errors
     *
     * @param \Illuminate\Validation\Validator|Validator $validator
     * @return array
     */
    public static function formErrors(Validator $validator): array
    {
        return [
            'status' => 'fail',
            'errors' => $validator->getMessageBag()->toArray()
        ];
    }

    /**
     * Response with redirect action. This is meant for ajax responses and is
     * not meant for direct redirecting to the page.
     *
     * @param $url string To redirect user to
     * @param string|null $message Optional message
     * @return array
     */
    public static function redirect(string $url, ?string $message = null): array
    {
        if ($message) {
            return [
                'status' => 'success',
                'message' => Reply::getTranslated($message),
                'action' => 'redirect',
                'url' => $url,
            ];
        }

        return [
            'status' => 'success',
            'action' => 'redirect',
            'url' => $url,
        ];
    }

    /**
     * Get the translated message.
     *
     * @param $message
     * @return mixed
     */
    private static function getTranslated($message)
    {
        $trans = trans($message);

        return ($trans == $message)
            ? $message
            : $trans;
    }
}
