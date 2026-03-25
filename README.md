# Gear4music Inventory Coding Challenge

## Interview Notes: Tradeoffs And Next Steps

I've made the solution intentionally straightforward. The goal was to complete the brief clearly and correctly within a 45-minute coding test.

### Tradeoffs Made For A 45-Minute Test

- I kept the architecture simple and easy to follow: contract/model/repository/service/controller/presenter.
- I used in-memory data so I could spend time on feature delivery instead of setup.
- I added digital products by extending Product, which kept changes focused and low-risk.
- I kept currency conversion in the service so pricing logic lives in one place.

### Current State of the Project

- Country visibility filtering works.
- Availability filtering works.
- Language fallback behavior works.
- Currency conversion works, with a safe GBP fallback.
- Output includes context (country/language/currency) and total count.
- JSON output includes enum condition values.
- Digital products go through the same controller/presenter pipeline without extra wiring.

### Next Improvements (If This Were Production)

- Introduce a repository interface to make testing and swapping data sources easier.
- Separate physical and digital shipping fields in the output, so digital items do not carry placeholder logistics values.
- Add automated tests around filtering and pricing behavior.
- Store data securely in a database rather than a JSON file.
- Move exchange rates out of constants to a configurable source.
