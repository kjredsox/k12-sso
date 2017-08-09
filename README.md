

JWT Properties | Description
------------ | -------------
iat | Issued At. The time the token was generated, this is used to help ensure that a given token gets used shortly after it's generated. 
jwt | JSON Web Token ID. A unique id for the token, used to prevent token replay attacks.
exp | Expiration time of token ( 5 Minutes form iat )
nbf | Defines the time before which the JWT MUST NOT be accepted for processing
iss | The issuer of the token. ie: https://SCHOOLNAME.myschoolapp.com
aud | The audience of the token. ie: The domain of the redirect url from the SSO Settings screen.


JWT Custom Properties | Description
------------ | -------------
uid | User Id from Profile
hid | Hosting Id from Profile
onapi | Url to get more user info. Must have API Access and valid API Token
