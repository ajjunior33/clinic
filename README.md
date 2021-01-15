O sistema está hospedado em um servidor da Digital Ocean

O acesso ssh e através:
Usuario:noadmin
Senha:fMri0%DOalii

Foi usado o Nginx para subir o  projeto. Está no sub-dominio http://clinica.whitecode.dev.br(134.122.8.104).

na pasta */var/www/html/dominios/clinic*

## Env, server e database

**Environment**

BASE_URL :http://clinica.whitecode.dev.br/api

**Server**

URL http://clinica.whitecode.dev.br/api

**Database**

```text
DB_CONNECTION=mysql
DB_HOST=whitecode-do-user-8562636-0.b.db.ondigitalocean.com
DB_PORT=25060
DB_DATABASE=clinica
DB_USERNAME=noadmin
DB_PASSWORD=zqxrwc0f4rvb5r5m
```





## Médicos

**Listagem de Médicos**

*[GET]{{ _.base_url }}/medics*

**Request**

*Optional*

```json
active=true
```

*{{_.base_url}}/medics/?active=true*

**Response**

```json
{
  "message": "Listagem de Médicos",
  "status": true,
  "data": [
    {
      "id": 1,
      "name": "Medico 01",
      "email": "medico01@clinic.com",
      "crm": "12345",
      "function": "Clinco Geral",
      "active": 1,
      "created_at": "2021-01-14T15:31:42.000000Z",
      "updated_at": "2021-01-14T15:31:42.000000Z",
      "deleted_at": null
    },
    {
      "id": 3,
      "name": "Medico 03",
      "email": "medico03@clinic.com",
      "crm": "10332",
      "function": "Pediatra",
      "active": 1,
      "created_at": "2021-01-14T15:31:42.000000Z",
      "updated_at": "2021-01-14T15:31:42.000000Z",
      "deleted_at": null
    }
  ]
}
```





[GET]{{ _.base_url }}/medics/:idMedic

**Buscar um Médico específico **

**Request**

*Required*

```json
/:idMedic
```

*{{_.base_url}}/medics/2*

**Response**

```json
{
  "message": "Medico encontrado",
  "status": true,
  "data": {
    "id": 2,
    "name": "Medico 02",
    "email": "medico02@clinic.com",
    "crm": "54321",
    "function": "Clinco Geral",
    "active": 0,
    "created_at": "2021-01-14T15:31:42.000000Z",
    "updated_at": "2021-01-14T15:31:42.000000Z",
    "deleted_at": null
  }
}
```



 [POST]{{ _.base_url }}/medics

**Criar um novo Médico**

**Request**

*Required*

```json
{
	"name": "Medico 01",
	"email": "medico01@clinic.com",
	"crm": "12345",
	"function": "Clinco Geral",
	"active": true
}
```

*{{_.base_url}}/medics/*

**Response**

```json
{
  "message": "Médico cadastrado com sucesso.",
  "status": true
}
||
{
  "message": "Já existe um médico que possuí esse CRM",
  "status": false
}
```





 [PUT]{{ _.base_url }}/medics/:idMedic

**Editar Médico**

**Request**

*Required*

```json
{
	"name": "André Souza",
	"email": "andresouza@clinic.com",
	"crm": "12345",
	"function": "Clinco Geral",
	"active": true
}
```

*{{_.base_url}}/medics/2*

**Response**

```json
{
  "message": "Médico Editado com sucesso.",
  "status": true
}
```



## Pacientes

**Listagem de Pacientes**

*[GET]{{ _.base_url }}/pacients*

**Request**

no request

*{{_.base_url}}/pacients*

**Response**

```json
[
  {
    "id": 1,
    "full_name": "João da Silva",
    "document": "12345678915",
    "email": "joaodasilva@hotmail.com",
    "gender": "male",
    "birth": "2020-10-20",
    "blood": "A+",
    "allergy": "Alergia a paracetamol",
    "deleted_at": null,
    "created_at": "2021-01-14T20:42:53.000000Z",
    "updated_at": "2021-01-14T20:42:53.000000Z"
  }
]
```





[GET]{{ _.base_url }}/pacients/:idPacient

**Buscar um Paciente específico **

**Request**

*Required*

```json
/:idMedic
```

*{{_.base_url}}/pacients/2*

**Response**

```json
{
  "pacient": {
    "id": 1,
    "full_name": "João da Silva",
    "document": "12345678915",
    "email": "joaodasilva@hotmail.com",
    "gender": "male",
    "birth": "2020-10-20",
    "blood": "A+",
    "allergy": "Alergia a paracetamol",
    "deleted_at": null,
    "created_at": "2021-01-14T20:42:53.000000Z",
    "updated_at": "2021-01-14T20:42:53.000000Z"
  },
  "address": [
    {
      "id": 1,
      "address": "Av. Principal",
      "city": "Vila Velha",
      "neighborhood": "Santa Fé",
      "state": "ES",
      "zip_code": "29153635",
      "number": "32",
      "main": 1,
      "pacient_id": 1,
      "created_at": "2021-01-14T20:42:53.000000Z",
      "updated_at": "2021-01-14T20:42:53.000000Z"
    }
  ],
  "phones": [
    {
      "id": 1,
      "type": "cell_phone",
      "owner": "Mariana da Silva",
      "number": "912345679",
      "prefixed": "27",
      "main": 1,
      "pacient_id": 1,
      "created_at": "2021-01-14T20:42:53.000000Z",
      "updated_at": "2021-01-14T20:42:53.000000Z"
    }
  ]
}
```



 [POST]{{ _.base_url }}/pacients

**Criar um novo Paciente**

**Request**

*Required*

```json
{
	"full_name":"João da Silva",
	"document":"12345678915",
	"email":"joaodasilva@hotmail.com",
	"gender":"male",
	"birth":"2020-10-20",
	"blood":"A+",
	"allergy":"Alergia a paracetamol",
	"main_address": {
		"address":"Av. Principal",
		"number":"32",
		"neighborhood":"Santa Fé",
		"city":"Vila Velha",
		"state":"ES",
		"zip_code":"29153635"
	},
	"phones":{
		"owner":"Mariana da Silva", "number":"912345679", "type":"cell_phone", "prefixed":"27", "main": true
	}
}
```

*{{_.base_url}}/pacients/*

**Response**

```json
{
  "message": "Paciente cadastrado com sucesso.",
  "status": true
}
```





 [DELETE]{{ _.base_url }}/pacients/:idPacient

**Deletar Médico**

**Request**

*Required*

```json
:idPacient
```

*{{_.base_url}}/pacients/2*

**Response**

```json
{
  "message": "Usuário excluído com sucesso."
}
```

## Address

**Listagem de Endereços**

*[GET]{{ _.base_url }}/address/:idPacient*

**Request**


```json
/:idPacient
```

*{{_.base_url}}/address*

**Response**

```json
{
  "message": "Lista de endereços",
  "stauts": true,
  "data": [
    {
      "id": 1,
      "address": "Av. Principal",
      "city": "Vila Velha",
      "neighborhood": "Santa Fé",
      "state": "ES",
      "zip_code": "29153635",
      "number": "32",
      "main": 1,
      "pacient_id": 1,
      "created_at": "2021-01-14T20:03:44.000000Z",
      "updated_at": "2021-01-14T20:03:44.000000Z"
    }
  ]
}
```

**Novo Endereços**

*[POST]{{ _.base_url }}/address*

**Request**

```json
{
    "address":"Av. Principal",
    "number":"32",
    "neighborhood":"Santa Fé",
    "city":"Vila Velha",
    "state":"ES",
    "zip_code":"29153635",
    "main": false,
    "pacient_id": 1
}
```

*{{_.base_url}}/address*

**Response**

```json
{
  "message": "Novo endereço cadastrado."
}
```


**Ediar Endereço Principal**
*[PUT]{{ _.base_url }}/address/updateMain/:idPacient/:idAddress*

**Request**

```json
    /:idPacient/:idAddress
```


*{{_.base_url}}/address/updateMain/1/1*

**Response**

```json
{
  "message": "Endereço principal alterado com sucesso.",
  "stauts": true
}
```



**Ediar Endereço**
*[PUT]{{ _.base_url }}/address/:idAddress*

**Request**
```json
{
	"owner":"Mariana da Silva", 
	"number":"988864791", 
	"type":"cell_phone", 
	"prefixed":"27", 
	"main": false, 
	"pacient_id":1
}
```

*{{_.base_url}}//address/1*

**Response**

```json
{
  "message": "Endereço editado com sucesso.",
  "stauts": true
}
```


**Deletar Endereço**
*[DELETE]{{ _.base_url }}/address/:idAddress*

**Request**

```json
/:idAddress
```

*{{_.base_url}}/address/2*

**Response**

```json
{
  "message": "Endereço editado com sucesso.",
  "stauts": true
}
```



## Phones

**Listagem de Telefones**

*[GET]{{ _.base_url }}/phones/:idPacient*

**Request**

```json
    /:idPacient
```

*{{_.base_url}}/phones/1*

**Response**

```json
{
  "message": "Lista de telefones",
  "stauts": true,
  "data": [
    {
      "id": 1,
      "type": "cell_phone",
      "owner": "Mariana da Silva",
      "number": "912345679",
      "prefixed": "27",
      "main": 1,
      "pacient_id": 1,
      "created_at": "2021-01-14T20:42:53.000000Z",
      "updated_at": "2021-01-14T20:42:53.000000Z"
    }
  ]
}
```

**Novo Telefone**

*[POST]{{ _.base_url }}/phones*

**Request**

```json
{
	"owner":"Mariana da Silva", 
	"number":"988864790", 
	"type":"cell_phone", 
	"prefixed":"27", 
	"main": false, 
	"pacient_id":1
}
```

*{{_.base_url}}/phones*

**Response**

```json
{
  "message": "Novo número de telefone cadastrado."
}
```


**Ediar Telefone Principal**
*[PUT]{{ _.base_url }}/address/updateMain/:idPacient/:idPhone*

**Request**

```json
    /:idPacient/:idPhone
```


*{{_.base_url}}/address/updateMain/1/1*

**Response**

```json
{
  "message": "Endereço principal alterado com sucesso.",
  "stauts": true
}
```



**Ediar Telefone**
*[PUT]{{ _.base_url }}/phones/:idPhone*

**Request**
```json
{
	"owner":"Mariana da Silva", 
	"number":"988864791", 
	"type":"cell_phone", 
	"prefixed":"27", 
	"main": false, 
	"pacient_id":1
}
```

*{{_.base_url}}/phones/1

**Response**

```json
{
  "message": "Número editado com sucesso.",
  "status": true
}
```


**Deletar Telefone**
*[DELETE]{{ _.base_url }}/phones/:idPhone*

**Request**

```json
/:idPhone
```

*{{_.base_url}}/phones/2*

**Response**

```json
{
  "message": "Número deletado com sucesso.",
  "stauts": true
}
```


## Diagnostics

**Lista de Diagnostico de um Paciente**

*[GET]{{ _.base_url }}/diagnostic/:documentPacient*

**Request**


```json
/:documentPacient
```

*{{_.base_url}}/diagnostic/12345678915*

**Response**

```json
{
  "message": "Diagnosticos",
  "status": true,
  "data": [
    {
      "id": 1,
      "diagnostic": "Paciente com câncer.",
      "diagnostic_type": "entry",
      "gravity": "green"
    },
    {
      "id": 2,
      "diagnostic": "Paciente parou com enjoo ao tomar remédio.",
      "diagnostic_type": "return",
      "gravity": "green"
    }
  ]
}
```

**Novo Diagnostico**

*[POST]{{ _.base_url }}/diagnostic*

**Request**


```json
{
	"gravity":"green",
	"diagnostic_type":"entry",
	"diagnostic":"Paciente com câncer.",
	"document_pacient":"12345678915",
	"crm_medic":"12345"
}
```

*{{_.base_url}}/diagnostic*

**Response**

```json
{
  "message": "Diagnostico registrado com sucesso.",
  "status": true
}
```


**Editar Diagnostico**

*[PUT]{{ _.base_url }}/diagnostic/:idDiagnostic*

**Request**


```json
{
	"id": 2,
	"diagnostic": "Paciente parou com enjoo ao tomar remédio.",
	"diagnostic_type": "return",
	"gravity": "green"
}
```

*{{_.base_url}}/diagnostic/2*

**Response**

```json
{
  "message": "Diagnostico editado com sucesso.",
  "status": true
}
```

## Auth
**Novo Diagnostico**

*[POST]{{ _.base_url }}/auth/login*

**Request**


```json
{
	"email":"admin@admin.com",
	"password":"12345678910"
}
```

*{{_.base_url}}/auth/login*

**Response**

```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9jbGluaWNhLndoaXRlY29kZS5kZXYuYnJcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MTA2NTcxMzMsImV4cCI6MTYxMDY2MDczMywibmJmIjoxNjEwNjU3MTMzLCJqdGkiOiJEbTFtUVg3VFRYc1BpaHZrIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.BbylzNpQPpFxiU_cGVamZS2L3SZPrAhtgPHd_xFnlfM",
  "token_type": "bearer",
  "expires_in": 3600
}   
```