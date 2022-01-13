# Changelog
All notable changes to this component will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this component adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.1.0] - 2021-03-23
### Added
- (Extension): Add `set_project`, `get_asset_namespace` function to support multi project environment.

## [2.0.1] - 2021-03-02

## [2.0.0] - 2020-11-17
### Changed
- (Extension): The parameter `$additionalCondition` of the `get_modifier` filter is moved inside the options array.
### Added
- (Extension): Add options array to the `get_modifier` filter.
- (Extension): Add parameter `$optionsObject["property"]` and `$optionsObject["omitDefaultModifier"]` to the `get_modifier` filter. This feature can be used to minimize the amount of css classes for the default state of a component.

## [1.3.0] - 2020-08-28
### Added
- (Extension): Make `render_attributes` as Twig function available.
- (Extension): Add additional parameters `styleAttributes` and `extensions` to the `render_attributes` filter and function.
- (Extension): Validate extensions provided in components and deeply validate the extension data.
