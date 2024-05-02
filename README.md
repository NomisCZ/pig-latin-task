# Pig Latin Translator

# About
Pig Latin is a language game, argot, or cant in which words in English are altered, usually by adding a fabricated suffix or by moving the onset or initial consonant or consonant cluster of a word to the end of the word and adding a vocalic syllable to create such a suffix.

Source: [Wikipedia](https://en.wikipedia.org/wiki/Pig_Latin)

# Info
- The mode with a dictionary (`--userDictionary 1 (default)`) is used to translate compound words (e.g., firefighter). If the word is found in the dictionary, each part is translated separately.
    - firecracker -> fire + cracker -> irefay + ackercray
- Without a dictionary (`--userDictionary 0`), the word is translated as it is.
    - firecracker -> irecrackerfay
- Words separated by a hyphen are translated in parts.
    - fire-cracker -> irefay-ackercray

# Installation
```bash
composer install
```

# Commands
## Translate
```bash
php console app:translate [-ud|--useDictionary [USEDICTIONARY]] [--] <value>
```
Examples:
```bash
php console app:translate firecracker
```
> Output: irefayackercray
```bash
php console app:translate --useDictionary 0 firecracker
```
> Output: irecrackerfay
```bash
php console app:translate fire-cracker
```
> Output: irefay-ackercray
```bash
php console app:translate "hello word apple and orange"
```
> Output: ellohay ordway appleyay andyay orangeyay

## Running tests
```bash
./vendor/bin/phpunit tests --colors
```

## Coding standards
```bash
./vendor/bin/phpcbf --standard=ruleset.xml -p -n
```
