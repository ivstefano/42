# 42
Answer to the Ultimate Question of Life, the Universe, and Everything

### Starting with Math: 
```
var getPos = function(letter) { 
        // Returns the letter ordinal number starting with 'A' == 1
        return letter.charCodeAt(0) - 64; 
    };
console.log(getPos('M') + getPos('A') + getPos('T') + getPos('H') == 42);
```
