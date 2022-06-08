
# API GERENCIADORA DE DISPOSITIVOS

Essa API foi feita para o trabalho da segunda unidade de Programação para dispositivos mobile



## Autores

- [@arthurmalakian](https://github.com/arthurmalakian)


## Instalação

Para rodar o projeto você precisará do [docker](https://www.docker.com/) e [docker-compose](https://docs.docker.com/compose/) istalados em sua maquina.


Copie o arquivo de ambiente pre-montado
```bash
  cp .env.dev .env
```

No diretório raíz do projeto rode os seguintes comandos para subir as maquinas virtuais.
```bash
  docker-compose build
  docker-compose up -d
```

Instale as dependencias do projeto.
```bash
  docker-compose exec app composer install
```

Realize a migração das tabelas necessárias.
```bash
  docker-compose exec app php artisan migrate
```


      
## Uso/Exemplos

Uma vez que a API esteja rodando, acesse a documentação da API no seguinte link: [http://localhost:8000/docs/](http://localhost:8000/docs/)

