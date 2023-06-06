<?php

if (!function_exists('debug')) {
  function debug($data)
  {
    echo "<pre>";
    print_r($data);
    die();
  }
}

if (!function_exists('format_phone')) {
  function format_phone($phone)
  {
    $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
    $matches       = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
    if ($matches) {
      return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
    }

    return $phone;
  }
}

if (!function_exists('format_cpf_cnpj')) {
  function format_cpf_cnpj($value)
  {
    $cnpj_cpf = preg_replace("/\D/", '', $value);

    if (strlen($cnpj_cpf) === 11) {
      return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
    }

    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
  }
}

if (!function_exists('format_pis')) {
  function format_pis($value)
  {
    $pis = preg_replace("/\D/", '', $value);

    if (strlen($pis) === 11) {
      return preg_replace("/(\d{3})(\d{5})(\d{2})(\d{1})/", "\$1.\$2.\$3-\$4", $pis);
    }
  }
}

if (!function_exists('format_date')) {
  function format_date($value, $format = "d/m/Y")
  {
    return (string) date_format(date_create($value), $format);
  }
}

if (!function_exists('format_money')) {
  function format_money($number, $symbol = true)
  {
    if (isset($number)) {
      if ($symbol) {
        return (string) "R$ " . number_format($number, 2, ",", ".");
      }
      return (string) number_format($number, 2, ",", ".");
    } else {
      return "";
    }
  }
}

if (!function_exists('month_format')) {
  function month_format($number)
  {
    switch ($number) {
      case 1:
        return "Janeiro";
        break;
      case 2:
        return "Fevereiro";
        break;
      case 3:
        return "Março";
        break;
      case 4:
        return "Abril";
        break;
      case 5:
        return "Maio";
        break;
      case 6:
        return "Junho";
        break;
      case 7:
        return "Julho";
        break;
      case 8:
        return "Agosto";
        break;
      case 9:
        return "Setembro";
        break;
      case 10:
        return "Outubro";
        break;
      case 11:
        return "Novembro";
        break;
      case 12:
        return "Dezembro";
        break;

      default:
        return "Dezembro";
        break;
    }
  }
}

if (!function_exists('buscar_endereco')) {
  function buscar_endereco($cep)
  {
    $cep = str_replace('.', '', $cep);
    $cep = str_replace('-', '', $cep);

    $url = 'http://republicavirtual.com.br/web_cep.php?cep=' . urlencode($cep) . '&formato=query_string';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 0);

    $resultado = curl_exec($ch);
    curl_close($ch);

    if (!$resultado) $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";

    $resultado = urldecode($resultado);
    $resultado = utf8_encode($resultado);
    parse_str($resultado, $retorno);

    return $retorno;
  }
}

if (!function_exists('only_numbers')) {
  function only_numbers($number)
  {
    return (string) preg_replace('/\D/', '', $number);
  }
}

if (!function_exists('format_number')) {
  function format_number($number)
  {
    $number = str_replace(",", ".", $number);

    return $number;
  }
}

if (!function_exists('format_text')) {
  function format_text($text)
  {
    $text = str_replace("_", " ", $text);

    return ucfirst($text);
  }
}

if (!function_exists('toast')) {
  function toast($type = "", $title = "", $message = "")
  {
    session()->setFlashData([
      $type => true,
      'title' => $title,
      'message' => $message,
    ]);
  }
}

if (!function_exists('toast_new')) {
  function toast_new($toast)
  {
    session()->setFlashData([
      $toast["type"] => true,
      'title' => $toast["title"],
      'message' => $toast["message"],
    ]);
  }
}

if (!function_exists('get_sistema_api')) {
  function get_sistema_api()
  {
    $sistema_id = apache_request_headers()["Sistema"];

    return $sistema_id;
  }
}
if (!function_exists('get_sistema_admin')) {
  function get_sistema_admin()
  {
    $sistema_id = session()->get("sistema")["id"];

    return $sistema_id;
  }
}

if (!function_exists('get_status_sistema')) {
  function get_status_sistema($aberto, $fechado)
  {
    $status = false;

    date_default_timezone_set('America/Sao_Paulo');

    $aberto = new DateTime($aberto);
    $fechado = new DateTime($fechado);

    if (
      $aberto->diff(new DateTime)->format('%R') == '+'
      &&
      $fechado->diff(new DateTime)->format('%R') == '-'
    ) {
      $status = true;
    }

    return $status;
  }
}
