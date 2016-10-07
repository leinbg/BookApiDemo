About me
----------
- rest Api
- subject transformers
- limitation && pagination
- filter subject with query object 

API Doc
-----------
- GET
    - get books (default 3)
        - api/v1/books
    - get 5 books
        - api/v1/books?limit=5
    - get all tags associate with book
        - api/v1/books/1/tags
    - get books sorted by rate
        - api/v1/books?popular
    - get books cost less than 100
        - api/v1/books?maxPrice=100
    - get books cost more than 100
        - api/v1/books?minPrice=100
    - get english books
        - api/v1/books?lang=english

todo
------
- tests
- post, update, delete