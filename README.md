## Remote Technical Challenge - TSHIRT & SONS

# Instalation:

After clone the project:
- Create an .env file and set permitions to storage and bootstrap/cache;
- Run composer install, migrate and db:seed.
    - By default, a user will be created to create a authentication token.
        - email: admin@admin.com; password: 12345678
    - By default, the system will be create 3 clients using seed to execute the tests.
- With the libraries installed, run the command 'php artisan jwt:secret' to generate a key. It can be verified on .env file.


# Endpoints:

- Authentication
    - POST  - '/login'                          : Create a Authentication Token based on credentials;
        - Body:
            - email;
            - password;

    - POST  - '/refresh'                        : Generate a new Authentication Token;
        - Header:
            - Authorization;

    - POST  - '/logout'                         : Inativate Token;
        - Header:
            - Authorization;


- Contacts
    - GET   - '/contacts'                       : Retrieve a paginated list with 10 itens by page of all contacts;
        - Header:
            - Authorization;
        
    - GET   - '/contacts/get-id/{id}'           : Retrieve a single contact by id;
        - Header:
            - Authorization;

    - GET   - '/contacts/get-name/{name}'       : Retrieve a single contact by name;
        - Header:
            - Authorization;

    - GET   - '/contacts/get-company/{company}' : Retrieve a single contact by company_id;
        - Header:
            - Authorization;

    - POST  - '/contacts/create'                : Create a single contact; 
        - Header:
            - Authorization;
        - Body:
            - company_id;   int     required
            - name;         string  required
            - phone;        string  required

    - POST  - '/contacts/store'                 : Create multiple contacts with the same company;
        - Header:
            - Authorization;
        - Body:
            - company_id;   int     required
            - contacts;     array   required

    - PUT   - '/contacts/update/{id}'           : Update a contact;
        - Header:
            - Authorization;
        - Body:
            - company_id;   int
            - name;         string
            - phone;        string


- Companies
    - GET   - '/companies'                      : List all companies without pagination;
        - Header:
            - Authorization;

- Notes
    - POST   - '/notes/create'                  : Store notes against a contact;
        - Header:
            - Authorization;
        - Body:
            - contact_id;   int     required
            - notes;        string  required

