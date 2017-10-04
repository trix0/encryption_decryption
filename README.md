# encryption_decryption
tripledes ecb,cbc

<b>fnEncrypt
encrypts message with tripledes ecb or cbc encryption
<b></b>
fnEncrypt($func,$input_message,$secret_key)
<b>$func</b>="ecb" or "cbc"
<b>$input_message</b>=secret you want to hide
<b>$secret_key</b>=string you use for encryption as a key

<b>ecb returns</b>
array-> first index = encrypted string

<b>cbc returns</b>
array-> first index= encrypted string, second index= initialization vector

<b>fnDencrypt</b>
function fnDecrypt($func,$input_message,$secret_key,$iv="base")

<b>$func</b>="ecb" or "cbc"
<b>$input_message</b>=encrypted string you want to decrypt
<b>$secret_key</b>=string you use for encryption as a key
<b>$iv</b>=if you use cbc decryption initialization vector is needed

<b>ecb,cbc returns </b>

decrypted string/original string




