### Autenticação 

Utilizei a autenticação JWT, por ser uma das mais famosas atualmente. Além de ser simples de implementar e um projeto como esse não precisar de uma estrutura como a do *laravel/passport*.

```json
{
    "email":"admin@admin.com",
    "password":"12345678910"
}
```


### Tasks
- [ ] Vincular endereço e telefones com usuário.
- [ ] Criar migration de problemas:
    ```php
        $table->id();
        $table->string('diagnosis', 255);
        $table->enum('diagnostic_type', ['entry', 'hospitalization','return','diary','exit']);
        $table->enum('gravity', ['green', 'yellow', 'red']);
        $table->longText('problem_description');
        $table->timestamps();
    ```