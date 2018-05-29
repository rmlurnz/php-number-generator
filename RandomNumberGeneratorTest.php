<?php
use PHPUnit\Framework\TestCase;

require('10k_rand.php');

class RandomNumberGeneratorTest extends TestCase
{
    public function testItOutputsCorrectly()
    {
        // for formatting purposes
        printf("\n\n");
        printf("For testing purposes, we will be working with only 10 numbers between 1 and 10 inclusive.\n\n");

        // declare useful paramaters
        $min = 1;
        $max = 10;
        $iterations = 10;

        // collect output of generator to compare against
        $output = $this->getActualOutput(execute($min, $max, $iterations));

        // check output for the correct number of iterations, and that
        // each number is output exactly once
        for ($i = 1; $i <= $iterations; $i++) {

            $iterationCount = substr_count(
                $output, "Output #".$i.": "
            );

            $outputCount = substr_count(
                $output, ": ".$i."\n"
            );

            $this->assertEquals(1, $iterationCount);
            $this->assertEquals(1, $outputCount);
        }
    }
}
