var InvalidMoneyException = function (message) {
    this.message = message;
    this.name = "InvalidMoneyException";
};

function Money(amount, currency) {
    this.validateAmount(amount);
    this.amount = amount;

    this.validateCurrency(currency);
    this.currency = currency.toUpperCase();
}

Money.prototype = {
    /**
     * Access methods
     */
    getAmount: function() {
        return this.amount;
    },

    getCurrency: function() {
        return this.currency;
    },

    /**
     * Validation methods
     */
    validateFloat: function(value) {
        if(isNaN(parseFloat(value))) {
            throw new InvalidMoneyException("The given value '" + value + "' is an invalid number");
        }
    },

    validatePositiveAmount: function(amount) {
        if(this.amount < 0) {
            throw new InvalidMoneyException("The amount of money cannot be negative");
        }
    },

    validateAmount: function(amount) {
        if (isNaN(parseFloat(amount))) {
            throw new InvalidMoneyException("The given amount is not a valid number");
        }

        this.validatePositiveAmount(amount);
    },

    validateCurrency: function(currency) {
        var availableCurrencies = ["EUR", "USD", "BGN"]; // maybe comes from backend

        currency = currency.toUpperCase();

        // Validates currency in the list of available currencies
        if(availableCurrencies.indexOf(currency) == -1) {
            throw new InvalidMoneyException("The currency you have provided is invalid");
        }
    },

    validateMoney: function(money) {
        if(!money instanceof Money) {
            throw new InvalidMoneyException("You can compare only objects of type Money");
        }

        if(this.getCurrency() != money.getCurrency()) {
            throw new InvalidMoneyException("You can only compare money of the same currency");
        }
    },

    validatePercentage: function(percentage) {
        percentage = parseFloat(percentage);
        if(isNaN(percentage)) {
            throw new InvalidMoneyException("The percentage should be a float number in the range [0..100]");
        }
        if(percentage < 0 || percentage > 100) {
            throw new InvalidMoneyException("The percentage should be a number in the range [0..100]");
        }
    },

    /**
     * Comparison
     */
    equals: function(money) {
        this.validateMoney(money);
        return this.getAmount() == money.getAmount();
    },

    lessThan: function(money) {
        this.validateMoney(money);
        return this.getAmount() < money.getAmount();
    },

    lessThanOrEqualTo: function(money) {
        this.validateMoney(money);
        return this.getAmount() <= money.getAmount();
    },

    moreThanOrEqualTo: function(money) {
        this.validateMoney(money);
        return this.getAmount() >= money.getAmount();
    },

    /**
     * Operation
     */
    add: function(money) {
        this.validateMoney(money);
        return new Money(this.getAmount() + money.getAmount(), this.currency);
    },

    subtract: function(money) {
        this.validateMoney(money);

        var amount = this.getAmount() - money.getAmount();
        this.validatePositiveAmount(amount);

        return new Money(amount, this.currency);
    },

    multiply: function(multiplier) {
        this.validateFloat(multiplier);
        return new Money(this.amount * multiplier, this.currency);
    },

    divide: function(divisor) {
        this.validateFloat(divisor);

        return new Money(this.amount * 100 / divisor / 100, this.currency);
    },

    allocate: function(percentage) {
        this.validatePercentage(percentage);
        percentage = parseFloat(percentage);
        var allocated = Math.round(this.amount * percentage) / 100;

        return [
            new Money(allocated, this.currency),
            new Money(this.amount - allocated, this.currency)
        ];
    }
};