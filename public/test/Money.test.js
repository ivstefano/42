/**
 * @author Ivo Stefanov
 */
var assert = require('assert');
var Money = require('../app/core/Money');
console.log(Money);

describe('Money', function () {
    /**
     * Validation methods
     */
    describe('#getAmount()', function () {
        it('should return the value 3.50', function () {
            assert.equal(3.50, (new Money(3.50, "EUR")).getAmount());
        });
    });

    describe('#getCurrency()', function () {
        it('should return the currency EUR', function () {
            assert.equal("EUR", (new Money(3.50, "EUR")).getCurrency());
        });
    });

    /**
     * Validation methods
     */
    // TODO: Implement the validation tests

    /**
     * Comparison
     */
    describe('#equals()', function () {
        it('should be equal to 3.50', function () {
            assert.equal(true, (new Money(3.50, "EUR")).equals(new Money(3.50, "EUR")));
        });
    });

    describe('#lessThan()', function () {
        it('should be less than 3.50', function () {
            assert.equal(true, (new Money(3.50, "EUR")).lessThan(new Money(5.50, "EUR")));
        });
    });

    describe('#lessThanOrEqualTo()', function () {
        it('should be less than 4.50 or equal to 3.50', function () {
            assert.equal(true, (new Money(3.50, "EUR")).lessThanOrEqualTo(new Money(4.50, "EUR")));
            assert.equal(true, (new Money(3.50, "EUR")).lessThanOrEqualTo(new Money(3.50, "EUR")));
        });
    });

    describe('#moreThan()', function () {
        it('should be more than 2.50', function () {
            assert.equal(true, (new Money(3.50, "EUR")).moreThan(new Money(2.50, "EUR")));
        });
    });

    describe('#moreThanOrEqualTo()', function () {
        it('should be less than 2.50 or equal to 3.50', function () {
            assert.equal(true, (new Money(3.50, "EUR")).moreThanOrEqualTo(new Money(2.50, "EUR")));
            assert.equal(true, (new Money(3.50, "EUR")).moreThanOrEqualTo(new Money(3.50, "EUR")));
        });
    });

    /**
     * Operation
     */
    describe('#add()', function () {
        it('3.50 and 1.50 should add up to 5', function () {
            assert.deepEqual(new Money(5, "EUR"), (new Money(3.50, "EUR")).add(new Money(1.50, "EUR")));
        });
    });

    describe('#subtract()', function () {
        it('3.50 and 1.50 should subtract down to 2', function () {
            assert.deepEqual(new Money(2, "EUR"), (new Money(3.50, "EUR")).subtract(new Money(1.50, "EUR")));
        });
    });

    describe('#multiply()', function () {
        it('2.50 multiplied by 2.25 should give 5.625', function () {
            assert.deepEqual(new Money(5.625, "EUR"), (new Money(2.50, "EUR")).multiply(2.25));
        });
    });

    describe('#divide()', function () {
        it('2.50 divided by 2 should give 1.25', function () {
            assert.deepEqual(new Money(1.25, "EUR"), (new Money(2.50, "EUR")).divide(2));
        });
    });
});