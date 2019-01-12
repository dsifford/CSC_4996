# Todo App

## Getting Started

### Requirements

-   [docker](https://docs.docker.com/install/#supported-platforms)
-   [docker-compose](https://docs.docker.com/compose/install)

### Running the application

Assuming you have a terminal opened to the root directory of this project, enter the following to get the application up and running...

```sh
$ docker-compose up -d
# The application will now be available at http://localhost:8080
```

To tear down the application run the following...

```sh
$ docker-compose down -v
```

## Application Details

### Functional Requirements

-   Users can add tasks.
-   Users can remove tasks.
-   Users can view tasks across pageloads (i.e. tasks saved to a database).

### Non-Functional Requirements

-   Software must remain open source.
-   HTML must be written with accessibility in mind.
-   All functions/methods/classes must be well-documented.

### System Architecture Diagram

![arch]

### Data Flow Diagram

![data-flow]

### Use Case

![use-case]

### Sequence Diagram

#### Add a todo

![seq-add-todo]

#### Toggle a todo

![seq-toggle-todo]

#### Delete a todo

![seq-delete-todo]

### Database Design

![database]

**Note:** The instructions call for 3 tables, however I found this to be unnecessary. That's why the above diagram only includes the single table. More tables can be added later if needed as the feature set grows.

### Class Diagram

![classes]

**Note:** The instructions call for 3 classes and for a system diagram. I could only find a need for 2 classes and there is no communication, composition, or inheritance between any of the classes so I did not include a system diagram. This app is too simple at the moment for that.

### Test Cases

Skipped this because it is too much of a pain to set up PHPUnit for something so miniscule. This can be set up later as the app grows.

[arch]: assets/arch.png
[classes]: assets/classes.png
[data-flow]: assets/data-flow.png
[database]: assets/database.png
[seq-add-todo]: assets/seq-add-todo.png
[seq-delete-todo]: assets/seq-delete-todo.png
[seq-toggle-todo]: assets/seq-toggle-todo.png
[use-case]: assets/use-case.png
