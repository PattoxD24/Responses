<?php

namespace Pattoxd;

class Response
{
  const HTTP_OK = 200;
  const HTTP_CREATED = 201;
  const HTTP_ACCEPTED = 202;
  const HTTP_NO_CONTENT = 204;
  const HTTP_BAD_REQUEST = 400;
  const HTTP_UNAUTHORIZED = 401;
  const HTTP_FORBIDDEN = 403;
  const HTTP_NOT_FOUND = 404;
  const HTTP_METHOD_NOT_ALLOWED = 405;
  const HTTP_NOT_ACCEPTABLE = 406;
  const HTTP_CONFLICT = 409;
  const HTTP_INTERNAL_SERVER_ERROR = 500;
  const HTTP_NOT_IMPLEMENTED = 501;
  const HTTP_BAD_GATEWAY = 502;
  const HTTP_SERVICE_UNAVAILABLE = 503;
  const HTTP_GATEWAY_TIMEOUT = 504;
  const HTTP_VERSION_NOT_SUPPORTED = 505;

  public static function send($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'application/json'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo json_encode($data);
    die();
  }



  public static function sendError($description, $message = 'Error', $status = self::HTTP_INTERNAL_SERVER_ERROR, $errorCode = 0, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'application/problem+json'
    ], $headers);
    self::send([
      "status" => $status,
      "message" => $message,
      "error" => [
        "code" => $errorCode,
        "description" => $description
      ]
    ], $status, $headers);
  }

  public static function sendSuccess($data, $status = self::HTTP_OK, $headers = [])
  {
    self::send([
      "status" => $status,
      "message" => "Success",
      "data" => $data
    ], $status, $headers);
  }

  public static function sendUnauthorized($data, $message = 'Unauthorized', $headers = [])
  {
    self::sendError($data, $message, self::HTTP_UNAUTHORIZED, 0, $headers);
  }

  public static function sendForbidden($message = 'Forbidden', $headers = [])
  {
    self::sendError($message, self::HTTP_FORBIDDEN, $headers);
  }

  public static function sendNotFound($data, $message = 'Not Found', $headers = [])
  {
    self::sendError($data, $message, self::HTTP_NOT_FOUND, 0, $headers);
  }

  public static function sendBadRequest($data, $message = 'Bad Request', $headers = [])
  {
    self::sendError($data, $message, self::HTTP_BAD_REQUEST, 0, $headers);
  }

  public static function sendConflict($data, $message = 'Conflict', $headers = [])
  {
    self::sendError($data, $message, self::HTTP_CONFLICT, 0, $headers);
  }

  public static function sendInternalError($message = 'Internal Server Error', $headers = [])
  {
    self::sendError($message, self::HTTP_INTERNAL_SERVER_ERROR, $headers);
  }

  public static function sendNotImplemented($message = 'Not Implemented', $headers = [])
  {
    self::sendError($message, self::HTTP_NOT_IMPLEMENTED, $headers);
  }

  public static function sendBadGateway($message = 'Bad Gateway', $headers = [])
  {
    self::sendError($message, self::HTTP_BAD_GATEWAY, $headers);
  }

  public static function sendServiceUnavailable($message = 'Service Unavailable', $headers = [])
  {
    self::sendError($message, self::HTTP_SERVICE_UNAVAILABLE, $headers);
  }

  public static function sendGatewayTimeout($message = 'Gateway Timeout', $headers = [])
  {
    self::sendError($message, self::HTTP_GATEWAY_TIMEOUT, $headers);
  }

  public static function sendVersionNotSupported($message = 'HTTP Version Not Supported', $headers = [])
  {
    self::sendError($message, self::HTTP_VERSION_NOT_SUPPORTED, $headers);
  }

  public static function sendMethodNotAllowed($message = 'Method Not Allowed', $headers = [])
  {
    self::sendError($message, self::HTTP_METHOD_NOT_ALLOWED, $headers);
  }

  public static function sendNotAcceptable($message = 'Not Acceptable', $headers = [])
  {
    self::sendError($message, self::HTTP_NOT_ACCEPTABLE, $headers);
  }

  public static function sendNoContent($message = 'No Content', $headers = [])
  {
    self::sendSuccess($message, self::HTTP_NO_CONTENT, $headers);
  }

  public static function sendAccepted($message = 'Accepted', $headers = [])
  {
    self::sendSuccess($message, self::HTTP_ACCEPTED, $headers);
  }

  public static function sendCreated($message = 'Created', $headers = [])
  {
    self::sendSuccess($message, self::HTTP_CREATED, $headers);
  }

  public static function sendOk($message = 'Ok', $headers = [])
  {
    self::sendSuccess($message, self::HTTP_OK, $headers);
  }

  public static function sendJson($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'application/json'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo json_encode($data);
  }

  public static function sendXml($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'application/xml'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo $data;
  }

  public static function sendHtml($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'text/html'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo $data;
  }

  public static function sendText($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'text/plain'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo $data;
  }

  public static function sendFile($data, $status = self::HTTP_OK, $headers = [])
  {
    $headers = array_merge([
      'Content-Type' => 'application/octet-stream'
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }

    echo $data;
  }

  public static function sendRedirect($url, $status = self::HTTP_MOVED_PERMANENTLY, $headers = [])
  {
    $headers = array_merge([
      'Location' => $url
    ], $headers);

    http_response_code($status);

    foreach ($headers as $key => $value) {
      header($key . ': ' . $value);
    }
  }
}