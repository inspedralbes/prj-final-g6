
console.log('API_TOKEN_SALT:',);
console.log('TRANSFER_TOKEN_SALT:',);
module.exports = ({ env }) => ({
  auth: {
    secret: env('ADMIN_JWT_SECRET', 'utJj4t4G/HkhpJTa+iAXnw=='),
  },
  apiToken: {
    salt: env('API_TOKEN_SALT',  'ZHGorGs1qsdhQCcjdNqXJw=='),
  },
  transfer: {
    token: {
      salt: env('TRANSFER_TOKEN_SALT' , 'vvOCRPV3UAxmuJuFJFRL5g=='),
    },
  },
  flags: {
    nps: env.bool('FLAG_NPS', true),
    promoteEE: env.bool('FLAG_PROMOTE_EE', true),
  },
});
