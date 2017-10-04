# encryption_decryption
tripledes ecb,cbc

fnEncrypt
encrypts message with tripledes ecb or cbc encryption

fnEncrypt($func,$input_message,$secret_key)
$func="ecb" or "cbc"
$input_message=secret you want to hide
$secret_key=string you use for encryption as a key

ecb returns
array-> first index = encrypted string

cbc returns
array-> first index= encrypted string, second index= initialization vector

fnDencrypt
function fnDecrypt($func,$input_message,$secret_key,$iv="base")

$func="ecb" or "cbc"
$input_message=encrypted string you want to decrypt
$secret_key=string you use for encryption as a key
$iv=if you use cbc decryption initialization vector is needed

ecb,cbc returns 

decrypted string/original string




