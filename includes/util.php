<?php
function esc_html( $text ) {
    $safe_text = check_invalid_utf8( $text );
    $safe_text = _srz_specialchars( $safe_text, ENT_QUOTES );
    /**
     * Filters a string cleaned and escaped for output in HTML.
     *
     * Text passed to esc_html() is stripped of invalid or special characters
     * before output.
     *
     * @since 2.8.0
     *
     * @param string $safe_text The text after it has been escaped.
     * @param string $text      The text prior to being escaped.
     */
    return $safe_text;
}


function pre_kses_less_than_callback( $matches ) {
    if ( false === strpos( $matches[0], '>' ) ) {
        return esc_html( $matches[0] );
    }
    return $matches[0];
}

function _pre_kses_less_than( $text ) {
    return preg_replace_callback( '%<[^>]*?((?=<)|>|$)%', 'pre_kses_less_than_callback', $text );
}


function strip_all_tags( $string, $remove_breaks = false ) {
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags( $string );
 
    if ( $remove_breaks ) {
        $string = preg_replace( '/[\r\n\t ]+/', ' ', $string );
    }
 
    return trim( $string );
}

function _sanitize_text_fields( $str, $keep_newlines = false ) {
    if ( is_object( $str ) || is_array( $str ) ) {
        return '';
    }
 
    $str = (string) $str;
 
    $filtered = check_invalid_utf8( $str );
 
    if ( strpos( $filtered, '<' ) !== false ) {
        $filtered = _pre_kses_less_than( $filtered );
        // This will strip extra whitespace for us.
        $filtered = strip_all_tags( $filtered, false );
 
        // Use HTML entities in a special case to make sure no later
        // newline stripping stage could lead to a functional tag.
        $filtered = str_replace( "<\n", "&lt;\n", $filtered );
    }
 
    if ( ! $keep_newlines ) {
        $filtered = preg_replace( '/[\r\n\t ]+/', ' ', $filtered );
    }
    $filtered = trim( $filtered );
 
    $found = false;
    while ( preg_match( '/%[a-f0-9]{2}/i', $filtered, $match ) ) {
        $filtered = str_replace( $match[0], '', $filtered );
        $found    = true;
    }
 
    if ( $found ) {
        // Strip out the whitespace that may now exist after removing the octets.
        $filtered = trim( preg_replace( '/ +/', ' ', $filtered ) );
    }
 
    return $filtered;
}

 

 


function __($text,$name=''){
    return $text;
}
function req_post($name){
    if(isset($_POST[$name])){
        return $_POST[$name];
    }
    return '';
}
function maybe_unserialize( $data ) {
    if ( is_serialized( $data ) ) { // Don't attempt to unserialize data that wasn't serialized going in.
        return @unserialize( trim( $data ) );
    }
 
    return $data;
}

function maybe_serialize( $data ) {
    if ( is_array( $data ) || is_object( $data ) ) {
        return serialize( $data );
    }
 
    /*
     * Double serialization is required for backward compatibility.
     * See https://core.trac.wordpress.org/ticket/12930
     * Also the world will end. See WP 3.6.1.
     */
    if ( is_serialized( $data, false ) ) {
        return serialize( $data );
    }
 
    return $data;
}

if(!function_exists('mime_content_typex')) {

    function mime_content_typex($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
}
function is_serialized( $data, $strict = true ) {
    // If it isn't a string, it isn't serialized.
    if ( ! is_string( $data ) ) {
        return false;
    }
    $data = trim( $data );
    if ( 'N;' === $data ) {
        return true;
    }
    if ( strlen( $data ) < 4 ) {
        return false;
    }
    if ( ':' !== $data[1] ) {
        return false;
    }
    if ( $strict ) {
        $lastc = substr( $data, -1 );
        if ( ';' !== $lastc && '}' !== $lastc ) {
            return false;
        }
    } else {
        $semicolon = strpos( $data, ';' );
        $brace     = strpos( $data, '}' );
        // Either ; or } must exist.
        if ( false === $semicolon && false === $brace ) {
            return false;
        }
        // But neither must be in the first X characters.
        if ( false !== $semicolon && $semicolon < 3 ) {
            return false;
        }
        if ( false !== $brace && $brace < 4 ) {
            return false;
        }
    }
    $token = $data[0];
    switch ( $token ) {
        case 's':
            if ( $strict ) {
                if ( '"' !== substr( $data, -2, 1 ) ) {
                    return false;
                }
            } elseif ( false === strpos( $data, '"' ) ) {
                return false;
            }
            // Or else fall through.
        case 'a':
        case 'O':
            return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
        case 'b':
        case 'i':
        case 'd':
            $end = $strict ? '$' : '';
            return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
    }
    return false;
}


function check_invalid_utf8( $string, $strip = false ) {
    $string = (string) $string;
 
    if ( 0 === strlen( $string ) ) {
        return '';
    }
 
    // Store the site charset as a static to avoid multiple calls to get_option().
    static $is_utf8 = null;
    if ( ! isset( $is_utf8 ) ) {
        $is_utf8 = in_array( 'utf8', array( 'utf8', 'utf-8', 'UTF8', 'UTF-8' ), true );
    }
    if ( ! $is_utf8 ) {
        return $string;
    }
 
    // Check for support for utf8 in the installed PCRE library once and store the result in a static.
    static $utf8_pcre = null;
    if ( ! isset( $utf8_pcre ) ) {
        // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
        $utf8_pcre = @preg_match( '/^./u', 'a' );
    }
    // We can't demand utf8 in the PCRE installation, so just return the string in those cases.
    if ( ! $utf8_pcre ) {
        return $string;
    }
 
    // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- preg_match fails when it encounters invalid UTF8 in $string.
    if ( 1 === @preg_match( '/^./us', $string ) ) {
        return $string;
    }
 
    // Attempt to strip the bad chars if requested (not recommended).
    if ( $strip && function_exists( 'iconv' ) ) {
        return iconv( 'utf-8', 'utf-8', $string );
    }
 
    return '';
}

function esc_attr( $text ) {
    $safe_text = check_invalid_utf8( $text );
    $safe_text = _srz_specialchars( $safe_text, ENT_QUOTES );
    /**
     * Filters a string cleaned and escaped for output in an HTML attribute.
     *
     * Text passed to esc_attr() is stripped of invalid or special characters
     * before output.
     *
     * @since 2.0.6
     *
     * @param string $safe_text The text after it has been escaped.
     * @param string $text      The text prior to being escaped.
     */
    return $safe_text;
}

function _srz_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
    $string = (string) $string;
 
    if ( 0 === strlen( $string ) ) {
        return '';
    }
 
    // Don't bother if there are no specialchars - saves some processing.
    if ( ! preg_match( '/[&<>"\']/', $string ) ) {
        return $string;
    }
 
    // Account for the previous behaviour of the function when the $quote_style is not an accepted value.
    if ( empty( $quote_style ) ) {
        $quote_style = ENT_NOQUOTES;
    } elseif ( ENT_XML1 === $quote_style ) {
        $quote_style = ENT_QUOTES | ENT_XML1;
    } elseif ( ! in_array( $quote_style, array( ENT_NOQUOTES, ENT_COMPAT, ENT_QUOTES, 'single', 'double' ), true ) ) {
        $quote_style = ENT_QUOTES;
    }
 
    // Store the site charset as a static to avoid multiple calls to wp_load_alloptions().
    if ( ! $charset ) {
        static $_charset = null;
        if ( ! isset( $_charset ) ) { }
        $charset = 'utf8';
    }
 
    if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ), true ) ) {
        $charset = 'UTF-8';
    }
 
    $_quote_style = $quote_style;
 
    if ( 'double' === $quote_style ) {
        $quote_style  = ENT_COMPAT;
        $_quote_style = ENT_COMPAT;
    } elseif ( 'single' === $quote_style ) {
        $quote_style = ENT_NOQUOTES;
    }
 
    if ( ! $double_encode ) {
        // Guarantee every &entity; is valid, convert &garbage; into &amp;garbage;
        // This is required for PHP < 5.4.0 because ENT_HTML401 flag is unavailable.
        $string = kses_normalize_entities( $string, ( $quote_style & ENT_XML1 ) ? 'xml' : 'html' );
    }
 
    $string = htmlspecialchars( $string, $quote_style, $charset, $double_encode );
 
    // Back-compat.
    if ( 'single' === $_quote_style ) {
        $string = str_replace( "'", '&#039;', $string );
    }
 
    return $string;
}
function valid_unicode( $i ) {
    return ( 0x9 == $i || 0xa == $i || 0xd == $i ||
            ( 0x20 <= $i && $i <= 0xd7ff ) ||
            ( 0xe000 <= $i && $i <= 0xfffd ) ||
            ( 0x10000 <= $i && $i <= 0x10ffff ) );
}

function kses_normalize_entities2( $matches ) {
	        if ( empty( $matches[1] ) ) {
	                return '';
	        }
	
	        $i = $matches[1];
	        if ( valid_unicode( $i ) ) {
	                $i = str_pad( ltrim( $i, '0' ), 3, '0', STR_PAD_LEFT );
	                $i = "&#$i;";
	        } else {
	                $i = "&amp;#$i;";
	        }
	
	        return $i;
	}
function kses_xml_named_entities( $matches ) {
    $allowedentitynames=[];
    $allowedxmlnamedentities=[];
 
    if ( empty( $matches[1] ) ) {
        return '';
    }
 
    $i = $matches[1];
 
    if ( in_array( $i, $allowedxmlnamedentities, true ) ) {
        return "&$i;";
    } elseif ( in_array( $i, $allowedentitynames, true ) ) {
        return html_entity_decode( "&$i;", ENT_HTML5 );
    }
 
    return "&amp;$i;";
}

function kses_normalize_entities( $string, $context = 'html' ) {
    // Disarm all entities by converting & to &amp;
    $string = str_replace( '&', '&amp;', $string );
 
    // Change back the allowed entities in our list of allowed entities.
    if ( 'xml' === $context ) {
        $string = preg_replace_callback( '/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'kses_xml_named_entities', $string );
    } else {
        $string = preg_replace_callback( '/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'kses_named_entities', $string );
    }
    $string = preg_replace_callback( '/&amp;#(0*[0-9]{1,7});/', 'kses_normalize_entities2', $string );
    $string = preg_replace_callback( '/&amp;#[Xx](0*[0-9A-Fa-f]{1,6});/', 'kses_normalize_entities3', $string );
 
    return $string;
}
	function kses_normalize_entities3( $matches ) {
	        if ( empty( $matches[1] ) ) {
	                return '';
	        }
	
	        $hexchars = $matches[1];
	        return ( ! valid_unicode( hexdec( $hexchars ) ) ) ? "&amp;#x$hexchars;" : '&#x' . ltrim( $hexchars, '0' ) . ';';
	}

function kses_named_entities( $matches ) {
  $allowedentitynames=[];
    if ( empty( $matches[1] ) ) {
        return '';
    }
 
    $i = $matches[1];
    return ( ! in_array( $i, $allowedentitynames, true ) ) ? "&amp;$i;" : "&$i;";
}

function utf8_uri_encode( $utf8_string, $length = 0 ) {
    $unicode        = '';
    $values         = array();
    $num_octets     = 1;
    $unicode_length = 0;
 
    mbstring_binary_safe_encoding();
    $string_length = strlen( $utf8_string );
    reset_mbstring_encoding();
 
    for ( $i = 0; $i < $string_length; $i++ ) {
 
        $value = ord( $utf8_string[ $i ] );
 
        if ( $value < 128 ) {
            if ( $length && ( $unicode_length >= $length ) ) {
                break;
            }
            $unicode .= chr( $value );
            $unicode_length++;
        } else {
            if ( count( $values ) == 0 ) {
                if ( $value < 224 ) {
                    $num_octets = 2;
                } elseif ( $value < 240 ) {
                    $num_octets = 3;
                } else {
                    $num_octets = 4;
                }
            }
 
            $values[] = $value;
 
            if ( $length && ( $unicode_length + ( $num_octets * 3 ) ) > $length ) {
                break;
            }
            if ( count( $values ) == $num_octets ) {
                for ( $j = 0; $j < $num_octets; $j++ ) {
                    $unicode .= '%' . dechex( $values[ $j ] );
                }
 
                $unicode_length += $num_octets * 3;
 
                $values     = array();
                $num_octets = 1;
            }
        }
    }
 
    return $unicode;
}


function sanitize_title_with_dashexs( $title, $raw_title = '', $context = 'display' ) {
    $title = strip_tags( $title );
    // Preserve escaped octets.
    $title = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title );
    // Remove percent signs that are not part of an octet.
    $title = str_replace( '%', '', $title );
    // Restore octets.
    $title = preg_replace( '|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title );
 
    if ( seems_utf8( $title ) ) {
        if ( function_exists( 'mb_strtolower' ) ) {
            $title = mb_strtolower( $title, 'UTF-8' );
        }
        $title = utf8_uri_encode( $title, 200 );
    }
 
    $title = strtolower( $title );
 
    if ( 'save' === $context ) {
        // Convert &nbsp, &ndash, and &mdash to hyphens.
        $title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );
        // Convert &nbsp, &ndash, and &mdash HTML entities to hyphens.
        $title = str_replace( array( '&nbsp;', '&#160;', '&ndash;', '&#8211;', '&mdash;', '&#8212;' ), '-', $title );
        // Convert forward slash to hyphen.
        $title = str_replace( '/', '-', $title );
 
        // Strip these characters entirely.
        $title = str_replace(
            array(
                // Soft hyphens.
                '%c2%ad',
                // &iexcl and &iquest.
                '%c2%a1',
                '%c2%bf',
                // Angle quotes.
                '%c2%ab',
                '%c2%bb',
                '%e2%80%b9',
                '%e2%80%ba',
                // Curly quotes.
                '%e2%80%98',
                '%e2%80%99',
                '%e2%80%9c',
                '%e2%80%9d',
                '%e2%80%9a',
                '%e2%80%9b',
                '%e2%80%9e',
                '%e2%80%9f',
                // Bullet.
                '%e2%80%a2',
                // &copy, &reg, &deg, &hellip, and &trade.
                '%c2%a9',
                '%c2%ae',
                '%c2%b0',
                '%e2%80%a6',
                '%e2%84%a2',
                // Acute accents.
                '%c2%b4',
                '%cb%8a',
                '%cc%81',
                '%cd%81',
                // Grave accent, macron, caron.
                '%cc%80',
                '%cc%84',
                '%cc%8c',
            ),
            '',
            $title
        );
 
        // Convert &times to 'x'.
        $title = str_replace( '%c3%97', 'x', $title );
    }
 
    // Kill entities.
    $title = preg_replace( '/&.+?;/', '', $title );
    $title = str_replace( '.', '-', $title );
 
    $title = preg_replace( '/[^%a-z0-9 _-]/', '', $title );
    $title = preg_replace( '/\s+/', '-', $title );
    $title = preg_replace( '|-+|', '-', $title );
    $title = trim( $title, '-' );
 
    return $title;
}


function reset_mbstring_encoding() {
    mbstring_binary_safe_encoding( true );
}
function mbstring_binary_safe_encoding( $reset = false ) {
    static $encodings  = array();
    static $overloaded = null;
 
    if ( is_null( $overloaded ) ) {
        $overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 ); // phpcs:ignore PHPCompatibility.IniDirectives.RemovedIniDirectives.mbstring_func_overloadDeprecated
    }
 
    if ( false === $overloaded ) {
        return;
    }
 
    if ( ! $reset ) {
        $encoding = mb_internal_encoding();
        array_push( $encodings, $encoding );
        mb_internal_encoding( 'ISO-8859-1' );
    }
 
    if ( $reset && $encodings ) {
        $encoding = array_pop( $encodings );
        mb_internal_encoding( $encoding );
    }
}

function seems_utf8( $str ) {
    mbstring_binary_safe_encoding();
    $length = strlen( $str );
    reset_mbstring_encoding();
    for ( $i = 0; $i < $length; $i++ ) {
        $c = ord( $str[ $i ] );
        if ( $c < 0x80 ) {
            $n = 0; // 0bbbbbbb
        } elseif ( ( $c & 0xE0 ) == 0xC0 ) {
            $n = 1; // 110bbbbb
        } elseif ( ( $c & 0xF0 ) == 0xE0 ) {
            $n = 2; // 1110bbbb
        } elseif ( ( $c & 0xF8 ) == 0xF0 ) {
            $n = 3; // 11110bbb
        } elseif ( ( $c & 0xFC ) == 0xF8 ) {
            $n = 4; // 111110bb
        } elseif ( ( $c & 0xFE ) == 0xFC ) {
            $n = 5; // 1111110b
        } else {
            return false; // Does not match any model.
        }
        for ( $j = 0; $j < $n; $j++ ) { // n bytes matching 10bbbbbb follow ?
            if ( ( ++$i == $length ) || ( ( ord( $str[ $i ] ) & 0xC0 ) != 0x80 ) ) {
                return false;
            }
        }
    }
    return true;
}
function remove_accents( $string ) {
    if ( ! preg_match( '/[\x80-\xff]/', $string ) ) {
        return $string;
    }
 
    if ( seems_utf8( $string ) ) {
        $chars = array(
            // Decompositions for Latin-1 Supplement.
            'ª' => 'a',
            'º' => 'o',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'AE',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ð' => 'D',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'TH',
            'ß' => 's',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'ae',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'd',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'þ' => 'th',
            'ÿ' => 'y',
            'Ø' => 'O',
            // Decompositions for Latin Extended-A.
            'Ā' => 'A',
            'ā' => 'a',
            'Ă' => 'A',
            'ă' => 'a',
            'Ą' => 'A',
            'ą' => 'a',
            'Ć' => 'C',
            'ć' => 'c',
            'Ĉ' => 'C',
            'ĉ' => 'c',
            'Ċ' => 'C',
            'ċ' => 'c',
            'Č' => 'C',
            'č' => 'c',
            'Ď' => 'D',
            'ď' => 'd',
            'Đ' => 'D',
            'đ' => 'd',
            'Ē' => 'E',
            'ē' => 'e',
            'Ĕ' => 'E',
            'ĕ' => 'e',
            'Ė' => 'E',
            'ė' => 'e',
            'Ę' => 'E',
            'ę' => 'e',
            'Ě' => 'E',
            'ě' => 'e',
            'Ĝ' => 'G',
            'ĝ' => 'g',
            'Ğ' => 'G',
            'ğ' => 'g',
            'Ġ' => 'G',
            'ġ' => 'g',
            'Ģ' => 'G',
            'ģ' => 'g',
            'Ĥ' => 'H',
            'ĥ' => 'h',
            'Ħ' => 'H',
            'ħ' => 'h',
            'Ĩ' => 'I',
            'ĩ' => 'i',
            'Ī' => 'I',
            'ī' => 'i',
            'Ĭ' => 'I',
            'ĭ' => 'i',
            'Į' => 'I',
            'į' => 'i',
            'İ' => 'I',
            'ı' => 'i',
            'Ĳ' => 'IJ',
            'ĳ' => 'ij',
            'Ĵ' => 'J',
            'ĵ' => 'j',
            'Ķ' => 'K',
            'ķ' => 'k',
            'ĸ' => 'k',
            'Ĺ' => 'L',
            'ĺ' => 'l',
            'Ļ' => 'L',
            'ļ' => 'l',
            'Ľ' => 'L',
            'ľ' => 'l',
            'Ŀ' => 'L',
            'ŀ' => 'l',
            'Ł' => 'L',
            'ł' => 'l',
            'Ń' => 'N',
            'ń' => 'n',
            'Ņ' => 'N',
            'ņ' => 'n',
            'Ň' => 'N',
            'ň' => 'n',
            'ŉ' => 'n',
            'Ŋ' => 'N',
            'ŋ' => 'n',
            'Ō' => 'O',
            'ō' => 'o',
            'Ŏ' => 'O',
            'ŏ' => 'o',
            'Ő' => 'O',
            'ő' => 'o',
            'Œ' => 'OE',
            'œ' => 'oe',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            'Ŗ' => 'R',
            'ŗ' => 'r',
            'Ř' => 'R',
            'ř' => 'r',
            'Ś' => 'S',
            'ś' => 's',
            'Ŝ' => 'S',
            'ŝ' => 's',
            'Ş' => 'S',
            'ş' => 's',
            'Š' => 'S',
            'š' => 's',
            'Ţ' => 'T',
            'ţ' => 't',
            'Ť' => 'T',
            'ť' => 't',
            'Ŧ' => 'T',
            'ŧ' => 't',
            'Ũ' => 'U',
            'ũ' => 'u',
            'Ū' => 'U',
            'ū' => 'u',
            'Ŭ' => 'U',
            'ŭ' => 'u',
            'Ů' => 'U',
            'ů' => 'u',
            'Ű' => 'U',
            'ű' => 'u',
            'Ų' => 'U',
            'ų' => 'u',
            'Ŵ' => 'W',
            'ŵ' => 'w',
            'Ŷ' => 'Y',
            'ŷ' => 'y',
            'Ÿ' => 'Y',
            'Ź' => 'Z',
            'ź' => 'z',
            'Ż' => 'Z',
            'ż' => 'z',
            'Ž' => 'Z',
            'ž' => 'z',
            'ſ' => 's',
            // Decompositions for Latin Extended-B.
            'Ș' => 'S',
            'ș' => 's',
            'Ț' => 'T',
            'ț' => 't',
            // Euro sign.
            '€' => 'E',
            // GBP (Pound) sign.
            '£' => '',
            // Vowels with diacritic (Vietnamese).
            // Unmarked.
            'Ơ' => 'O',
            'ơ' => 'o',
            'Ư' => 'U',
            'ư' => 'u',
            // Grave accent.
            'Ầ' => 'A',
            'ầ' => 'a',
            'Ằ' => 'A',
            'ằ' => 'a',
            'Ề' => 'E',
            'ề' => 'e',
            'Ồ' => 'O',
            'ồ' => 'o',
            'Ờ' => 'O',
            'ờ' => 'o',
            'Ừ' => 'U',
            'ừ' => 'u',
            'Ỳ' => 'Y',
            'ỳ' => 'y',
            // Hook.
            'Ả' => 'A',
            'ả' => 'a',
            'Ẩ' => 'A',
            'ẩ' => 'a',
            'Ẳ' => 'A',
            'ẳ' => 'a',
            'Ẻ' => 'E',
            'ẻ' => 'e',
            'Ể' => 'E',
            'ể' => 'e',
            'Ỉ' => 'I',
            'ỉ' => 'i',
            'Ỏ' => 'O',
            'ỏ' => 'o',
            'Ổ' => 'O',
            'ổ' => 'o',
            'Ở' => 'O',
            'ở' => 'o',
            'Ủ' => 'U',
            'ủ' => 'u',
            'Ử' => 'U',
            'ử' => 'u',
            'Ỷ' => 'Y',
            'ỷ' => 'y',
            // Tilde.
            'Ẫ' => 'A',
            'ẫ' => 'a',
            'Ẵ' => 'A',
            'ẵ' => 'a',
            'Ẽ' => 'E',
            'ẽ' => 'e',
            'Ễ' => 'E',
            'ễ' => 'e',
            'Ỗ' => 'O',
            'ỗ' => 'o',
            'Ỡ' => 'O',
            'ỡ' => 'o',
            'Ữ' => 'U',
            'ữ' => 'u',
            'Ỹ' => 'Y',
            'ỹ' => 'y',
            // Acute accent.
            'Ấ' => 'A',
            'ấ' => 'a',
            'Ắ' => 'A',
            'ắ' => 'a',
            'Ế' => 'E',
            'ế' => 'e',
            'Ố' => 'O',
            'ố' => 'o',
            'Ớ' => 'O',
            'ớ' => 'o',
            'Ứ' => 'U',
            'ứ' => 'u',
            // Dot below.
            'Ạ' => 'A',
            'ạ' => 'a',
            'Ậ' => 'A',
            'ậ' => 'a',
            'Ặ' => 'A',
            'ặ' => 'a',
            'Ẹ' => 'E',
            'ẹ' => 'e',
            'Ệ' => 'E',
            'ệ' => 'e',
            'Ị' => 'I',
            'ị' => 'i',
            'Ọ' => 'O',
            'ọ' => 'o',
            'Ộ' => 'O',
            'ộ' => 'o',
            'Ợ' => 'O',
            'ợ' => 'o',
            'Ụ' => 'U',
            'ụ' => 'u',
            'Ự' => 'U',
            'ự' => 'u',
            'Ỵ' => 'Y',
            'ỵ' => 'y',
            // Vowels with diacritic (Chinese, Hanyu Pinyin).
            'ɑ' => 'a',
            // Macron.
            'Ǖ' => 'U',
            'ǖ' => 'u',
            // Acute accent.
            'Ǘ' => 'U',
            'ǘ' => 'u',
            // Caron.
            'Ǎ' => 'A',
            'ǎ' => 'a',
            'Ǐ' => 'I',
            'ǐ' => 'i',
            'Ǒ' => 'O',
            'ǒ' => 'o',
            'Ǔ' => 'U',
            'ǔ' => 'u',
            'Ǚ' => 'U',
            'ǚ' => 'u',
            // Grave accent.
            'Ǜ' => 'U',
            'ǜ' => 'u',
        );
 
        // Used for locale-specific rules.
        $locale = '';
 
        if ( in_array( $locale, array( 'de_DE', 'de_DE_formal', 'de_CH', 'de_CH_informal', 'de_AT' ), true ) ) {
            $chars['Ä'] = 'Ae';
            $chars['ä'] = 'ae';
            $chars['Ö'] = 'Oe';
            $chars['ö'] = 'oe';
            $chars['Ü'] = 'Ue';
            $chars['ü'] = 'ue';
            $chars['ß'] = 'ss';
        } elseif ( 'da_DK' === $locale ) {
            $chars['Æ'] = 'Ae';
            $chars['æ'] = 'ae';
            $chars['Ø'] = 'Oe';
            $chars['ø'] = 'oe';
            $chars['Å'] = 'Aa';
            $chars['å'] = 'aa';
        } elseif ( 'ca' === $locale ) {
            $chars['l·l'] = 'll';
        } elseif ( 'sr_RS' === $locale || 'bs_BA' === $locale ) {
            $chars['Đ'] = 'DJ';
            $chars['đ'] = 'dj';
        }
 
        $string = strtr( $string, $chars );
    } else {
        $chars = array();
        // Assume ISO-8859-1 if not UTF-8.
        $chars['in'] = "\x80\x83\x8a\x8e\x9a\x9e"
            . "\x9f\xa2\xa5\xb5\xc0\xc1\xc2"
            . "\xc3\xc4\xc5\xc7\xc8\xc9\xca"
            . "\xcb\xcc\xcd\xce\xcf\xd1\xd2"
            . "\xd3\xd4\xd5\xd6\xd8\xd9\xda"
            . "\xdb\xdc\xdd\xe0\xe1\xe2\xe3"
            . "\xe4\xe5\xe7\xe8\xe9\xea\xeb"
            . "\xec\xed\xee\xef\xf1\xf2\xf3"
            . "\xf4\xf5\xf6\xf8\xf9\xfa\xfb"
            . "\xfc\xfd\xff";
 
        $chars['out'] = 'EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy';
 
        $string              = strtr( $string, $chars['in'], $chars['out'] );
        $double_chars        = array();
        $double_chars['in']  = array( "\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe" );
        $double_chars['out'] = array( 'OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th' );
        $string              = str_replace( $double_chars['in'], $double_chars['out'], $string );
    }
 
    return $string;
}