SHELL = /bin/sh

targets = $(patsubst assets/diagrams/%.uml, assets/%.png, $(wildcard assets/diagrams/*.uml))
targets += $(patsubst assets/diagrams/%.dot, assets/%.png, $(wildcard assets/diagrams/*.dot))

.PHONY: all
all: main

.PHONY: clean
clean:
	@ rm -f $(targets)

main: $(targets)

assets/%.png: assets/diagrams/%.uml
	cat $< | docker run --rm -i think/plantuml -tpng > $@

assets/%.png: assets/diagrams/%.dot
	dot -Tpng -o $@ $<
