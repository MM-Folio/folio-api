# FolioAPI - JSON Documentation 
## Table of Contents
1. [Good to know](#good-to-know)
    1. [Authentication Groups](#authentication-groups)
    2. [Pagination](#pagination)
2. [Auth](#auth)
    1. [CSRF-Cookie](#csrf-cookie)
    2. [Login](#login)
    3. [Logout](#logout)
3. [Artists](#artists)
    1. [Artist-Index](#artist-index)
    2. [Artist-Store](#artist-store)
    3. [Artist-Edit](#artist-edit)
    4. [Artist-Update](#artist-update)
4. [Portfolios](#portfolios)
    1. [Portfolio-Index](#portfolio-index)
    2. [Portfolio-Show](#portfolio-show)
    3. [Portfolio-Artists](#portfolio-artists)
    4. [Portfolio-Edit](#portfolio-edit)
    5. [Portfolio-Store](#portfolio-store)
    6. [Portfolio-Update](#portfolio-update)
    7. [Portfolio-Add-Artist](#portfolio-add-artist)
    8. [Portfolio-Remove-Artist](#portfolio-remove-artist)
5. [Genres](#genres)
    1. [Genres Index](#genres-index)
    2. [Genres Show](#genres-show)
    3. [Genres Store](#genres-store)
    4. [Genres Update](#genres-update)
    5. [Genres Destroy](#genres-destroy)
6. [Misc. Texts](#misc-texts)
    1. [Texts Index](#texts-index)
    2. [Texts Show](#texts-show)
    3. [Texts Edit](#texts-edit)
    4. [Texts Store](#texts-store)
    5. [Texts Update](#texts-update)
    6. [Texts Destroy](#texts-destroy)



## Good to know
### Authentication Groups
Authentication Groups define how a Request is accessible
| Auth-Group | Accessibility |
|---|---|
| Authenticated | Is only accessible for authenticated sessions |
| Guest | Is publicly accessible |

### Pagination
Pagination is used for the reason that the API doesn't have to send everything at once.
| JSON-Element | Description |
|---|---|
| ``total_<object>`` | Gives back the amount of entries of the specific model |
| ``current_page`` | Gives back the current page number |
| ``total_pages`` | Gives back the total number of pages |
| ``first_page`` | Gives back the url to the first page |
| ``last_page`` | Gives back the url to the last page |
| ``prev_page`` | Gives back the url to the previous page. (Is null if ``current_page = 1`` ) |
| ``next_page`` | Gives back the url to the next page. (Is null if ``current_page = total_pages``) |

## Auth

### CSRF-Cookie
Request-Type: GET </br>
Path: /sanctum/csrf-cookie </br>
Auth-Group: Guest </br>
Usage: Writes the CSRF-Token needed for [Login](#login) and [Logout](#logout) into a Cookie

### Login
Request-Type: POST </br>
Path: /api/login </br>
Auth-Group: Guest </br>
JSON Request:
```json
{
    "email": string,
    "password": string
}
```
JSON Response:
```json
{
    "apiToken": string
}
```
Usage: Logs a Admin User in and gives back a bearer token for authentication

### Logout
Request-Type: POST </br>
Path: /api/logout </br>
Auth-Group: Authenticated </br>
Usage: Logs out a User and destroys the bearer token


## Artists

### Artist-Index
Request-Type: GET </br>
Path: /api/artists </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "artists": [
        {
            "id": integer,
            "name": string,
            "picture_url": string,
            "genre": string,
            "location": string,
            "isBand": boolean
        }
    ],
    "pagination": {
        "total_artists": integer,
        "current_page": integer,
        "total_pages": integer,
        "first_page": string,
        "last_page": string,
        "prev_page": string,
        "next_page": string,
    }   
}
```
Usage: Gives a compact list of all artists

### Artist-Store
Request-Type: POST </br>
Path: /api/artist </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "name": string,
    "picture_id": integer,
    "genre_id": integer,
    "location": string,
    "description": string,
    "instaHandle": string,
    "ytEmbedUrl": string,
    "spotifyEmbedUrl": string,
    "isBand": boolean
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Stores a artist
> Note: ``picture_id`` can only be fetched from [Image-Upload](#image-upload)

### Artist-Edit
Request-Type: GET </br>
Path: /api/artist/{id} </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "id": integer,
    "name": string,
    "picture_url": string,
    "picture_id": integer,
    "genre": {
        "id": integer,
        "name": string,
        "description": string
    },
    "location": string,
    "description": string,
    "instaHandle": string,
    "ytEmbedUrl": string,
    "spotifyEmbedUrl": string,
    "isBand": boolean
}
```
Usage: Gives all information for a update

### Artist-Update
Request-Type: POST </br>
Path: /api/artist/{id} </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "name": string,
    "picture_id": integer,
    "genre_id": integer,
    "location": string,
    "description": string,
    "instaHandle": string,
    "ytEmbedUrl": string,
    "spotifyEmbedUrl": string,
    "isBand": boolean
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Updates a artist

### Artist-Destroy
Request-Type: POST </br>
Path: /api/artist/{id}/destroy </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "message": string,
}
```

### Image-Upload
Request-Type: POST </br>
Path: /api/img </br>
Auth-Group: Authenticated
Request-Body:
- Form-Type: multipart/data-form
- Key: Image

JSON Response:
```json
{
    "message": string,
    "image_id": integer,
}
```
Usage: Upload Path for Artist Pictures that gives back the ``image_id `` needed for artists.





## Portfolios

### Portfolio-Index
Request-Type: GET </br>
Path: /api/portfolios </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "portfolios": [
        {
            "id": integer,
            "title": string,
            "created_at": datetime,
            "valid_till": date,
        }
    ],
    "pagination": {
        "total_artists": integer,
        "current_page": integer,
        "total_pages": integer,
        "first_page": string,
        "last_page": string,
        "prev_page": string,
        "next_page": string,
    }

}
```
Usage: Gives a compact list of all portfolios

### Portfolio-Show
Request-Type: GET </br>
Path: /api/portfolio/{urlId} </br>
Auth-Group: Guest </br>
JSON Response:
```json
{
    "title": string,
    "artists":[
        {
            "name": string,
            "picture_url": string,
            "genre": string,
            "location": string,
            "description": string,
            "instaHandle": string,
            "ytEmbedUrl": string,
            "spotifyEmbedUrl": string,
            "isBand": boolean
        },
    ],
}
```
Usage: Gives the a whole Portfolio for public
> Note: Currently the Id to get the portfolio is a Base64 string of Schema "view{id}" will be changed in the fututre

### Portfolio-Artists
Request-Type: GET </br>
Path: /api/portfolio/{id}/artists </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "id": integer,
    "title": string,
    "artists": [
        {
            "id": integer,
            "name": string,
            "picture_url": string,
            "genre": string,
            "location": string

        }
    ],
}
``` 
Usage: Gives all artists that are atached to a Portfolio

### Portfolio-Edit
Request-Type: GET </br>
Path: /api/portfolio/{id}/edit </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "title": string,
    "valid_till": date, 
}
```
Usage: Gives all required info to edit a Portfolio


### Portfolio-Store
Request-Type: POST </br>
Path: /api/portfolio </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "title": string,
    "valid_till": date, 
}
``` 
JSON Response:
```json
{
    "message": string,
    "redirect_url": string
}
```
Usage: Creates a Porfoliio and gives back a response with a Redirect-Url leading to the Edit-Endpoint

### Portfolio-Update
Request-Type: POST </br>
Path: /api/portfolio/{id} </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "title": string,
    "valid_till": date, 
}
``` 
JSON Response:
```json
{
    "message": string,
    "redirect_url": string
}
```
Usage: Updates a Porfoliio and gives back a response with a Redirect-Url leading to the Edit-Endpoint

### Portfolio-Add-Artist
Request-Type: POST </br>
Path: /api/portfolio/{id}/artists/{artistId} </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "message": string,
}
```
Usage: Attaches a Artist to a Portfolio

### Portfolio-Remove-Artist
Request-Type: POST </br>
Path: /api/portfolio/{id}/artists/{artistId} </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "message": string,
}
```
Usage: Dettaches a Artist from a Portfolio

## Genres
### Genres Index
Request-Type: GET </br>
Path: /api/genres </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
[
    {
        "id": integer,
        "name": string,
        "description": string,
    }
]
```
Usage: Gives back a list with all genres

### Genres Show
Request-Type: GET </br>
Path: /api/genres/{id} </br>
Auth-Group: Guest </br>
JSON Response:
```json
{
    "id": integer,
    "name": string,
    "description": string,
}
```
Usage: Gives back the requested genre

### Genres Store
Request-Type: POST </br>
Path: /api/genres </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "name": string,
    "description": string,
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Stores a genre into the database

### Genres Update
Request-Type: POST </br>
Path: /api/genres/{id} </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "name": string,
    "description": string,
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Updates a genre

### Genres Destroy
Request-Type: POST </br>
Path: /api/genres/{id}/destroy </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "message": string,
}
```
Usage: Deletes a genre




## Misc. Texts
### Texts Index
Request-Type: GET </br>
Path: /api/texts </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
[
    {
        "id": integer,
        "textId": string,
    }
]
```
Usage: Gives back a list of all texts that are stored in the database

### Texts Show
Request-Type: GET </br>
Path: /api/texts/{textId} </br>
Auth-Group: Guest </br>
JSON Response:
```json
{
    "textId": string,
    "text": string,
}
```
Usage: Gives back the requested text

### Texts Edit
Request-Type: GET </br>
Path: /api/texts/{id}/edit </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "id": integer,
    "textId": string,
}
```
Usage: Gives back all data about a Text

### Texts Store
Request-Type: POST </br>
Path: /api/texts </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "textId": string,
    "text": string,
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Stores a text into the database

### Texts Update
Request-Type: POST </br>
Path: /api/texts/{id} </br>
Auth-Group: Authenticated </br>
JSON Request:
```json
{
    "textId": string,
    "text": string,
}
```
JSON Response:
```json
{
    "message": string,
}
```
Usage: Updates a text

### Texts Destroy
Request-Type: POST </br>
Path: /api/texts/{id}/destroy </br>
Auth-Group: Authenticated </br>
JSON Response:
```json
{
    "message": string
}
```
Usage: Deletes a text