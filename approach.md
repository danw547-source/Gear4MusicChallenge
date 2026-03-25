# Approach

I broke this down into three smaller problems and solved them one at a time before combining everything:

- Language
- Currency
- Country visibility

From there, I organised the code into clear layers: Contract, Model, Repository, Service, Controller, and View/Presenter. This gave each responsibility a clear place and made the proof of concept easier to follow.

At the model level, Product holds the core data: translated names, a base GBP price, country visibility rules, stock and delivery details, and a condition field (new, used, or refurbished, defaulting to new).

For behaviour, I kept it simple and predictable:

- Name lookup falls back to English if a translation is missing, then to SKU.
- Country checks are case-insensitive to avoid input-format issues.

For data, I used InMemoryProductRepository with a small set of hardcoded products to keep the example focused.

The main logic sits in InventoryService. It:

- Loads products
- Filters by country visibility and availability
- Selects translated names
- Converts prices from GBP to the requested currency (GBP, EUR, USD)
- Returns clean output rows, including condition

Currency input is normalised to uppercase so handling is consistent. Unknown currency values fall back to GBP, and prices are rounded to 2 decimal places.

The controller stays thin: it accepts country, language, and currency, then delegates to the service. The presenter returns structured JSON containing request context, product rows, and a total count.

For Part 2, I added support for condition and digital products. Digital products are always visible and available, have no physical delivery fields, and always use the new condition because digital items do not have physical wear.

Demo examples:

- Example A (GB / en / GBP): returns 3 physical and 2 digital products.
- Example B (FR / fr / EUR): hides UK-only items (for example, the drum kit), switches to translated names, and converts prices to EUR.
- Physical products can appear as used or refurbished, while digital products remain new.

Overall, the aim was to keep the solution practical for a timed exercise while still structuring it in a way that can scale.