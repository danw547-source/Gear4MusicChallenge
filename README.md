# Gear4Music Inventory Management Challenge

A PHP-based inventory system demonstrating clean architecture and scalable design patterns. Built as a 45-minute coding challenge, this proof of concept showcases how to extend an existing inventory system to support internationalization, multi-currency pricing, and complex product filtering.

## Features

- **Multi-language support** – Product names translate with intelligent fallback (French → English → SKU)
- **Multi-currency conversion** – Automatic price conversion between GBP, EUR, and USD with safe fallback handling
- **Country-based visibility** – Filter products by country availability rules (case-insensitive validation)
- **Product conditions** – Support for new, used, and refurbished items
- **Digital products** – Extensible model for digital products alongside physical inventory
- **Clean architecture** – Organized into Contract, Model, Repository, Service, Controller, and Presenter layers

## Tech Stack

- PHP (OOP with clean separation of concerns)
- PSR-4 autoloading with Composer
- In-memory data storage for fast iteration

## Design Highlights

- Thin controller layer with business logic in the service
- Type-safe model classes with JSON output
- Extensible repository pattern for easy data source swapping
- JSON-structured responses with context and metadata

## Interview Notes: Tradeoffs And Next Steps

This solution was intentionally kept straightforward to complete the brief clearly and correctly within a 45-minute coding test.

### Tradeoffs Made For A 45-Minute Test

- Simple, easy-to-follow architecture: contract/model/repository/service/controller/presenter
- In-memory data storage to focus on feature delivery instead of setup
- Digital products extend Product, keeping changes focused and low-risk
- Currency conversion in the service keeps pricing logic in one place

### Current State of the Project

- ✓ Country visibility filtering works
- ✓ Availability filtering works
- ✓ Language fallback behavior works
- ✓ Currency conversion works, with a safe GBP fallback
- ✓ Output includes context (country/language/currency) and total count
- ✓ JSON output includes enum condition values
- ✓ Digital products go through the same controller/presenter pipeline without extra wiring

### Next Improvements (If This Were Production)

- Introduce a repository interface to make testing and swapping data sources easier
- Separate physical and digital shipping fields in the output
- Add automated tests around filtering and pricing behavior
- Store data securely in a database rather than in-memory
- Move exchange rates out of constants to a configurable source
