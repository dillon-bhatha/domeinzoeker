<p align="center"><h1>Minty Stage opdracht Domein Zoeker</h1></p>

Welkom bij de back-end opdracht. In deze opdracht ga je een 'Domein zoeker' maken. Een [end-user](https://en.wikipedia.org/wiki/End_user) moet een domein kunnen zoeken en een domein kunnen toevoegen aan zijn/haar winkelmand. Het design is bij deze opdracht niet van belang. Mocht je echter wel jouw design skills willen laten zien, mag dat natuurlijk altijd! :)

De volgende features moeten werken in je eind resultaat:
- Gebruik de REST API om data op te halen/versturen
- Laat tenminste `10` verschillende tld's zien met prijzen (op basis van end-user input)
- In de web pagina aangeven of het domein beschikbaar is of niet.
- Maak een winkelwagen waar domeinen aan toegevoegd kunnen worden
    - Wanneer [tld](https://www.semrush.com/blog/top-level-domains/) niet beschikbaar is moet het niet mogelijk zijn om die toe te kunnen voegen aan de winkelmand
    - Domeinen weer uit winkelmand kunnen halen
- Bereken het subtotaal + [btw](https://en.wikipedia.org/wiki/Value-added_tax) en laat deze op de checkout pagina zien.
    - Voeg een bestelling toe aan een database (klik [hier](#database) voor meer info)
- Een lijst met bestellingen.


## API
De base url is `https://dev.api.mintycloud.nl/api/v2.1`
Om te connecteren met de API moet je de header `Authorization` toevoegen:
```
Authorization: Basic 072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d
```

Je kan nu de route `POST /domains/search?with_price=true` gebruiken
Hierin moet je een request body ([json](https://www.json.org/)) meegeven:
```json
[
    {
        "name": "example",
        "extension": "com"
    },
    {
        "name": "example",
        "extension": "nl"
    }
]
```

Zoals je ziet kan je meerdere tld's toevoegen aan de request body.
Dit kan een response body voorstellen:

```json
[
    {
        "domain": "example.com",
        "status": "free",
        "price": 15
    },
    {
        "domain": "example.nl",
        "status": "free",
        "price": 15
    }
]
```

## Database
Je moet zelf een database regelen. Het liefst met [MySQL](https://www.mysql.com/) vanwege wij dit voor onze projecten ook gebruiken. De structuur van de database mag je zelf bedenken. Zorg er wel voor dat de subtotaal en de btw gezien kan worden op de bestellingen pagina.
