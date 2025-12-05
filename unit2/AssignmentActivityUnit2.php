<?php
/**
 * School Grading System
 * Implements basic arithmetic operations, conditional logic, and loops
 */

echo "=== SCHOOL GRADING SYSTEM ===\n\n";

// Part 1: Basic Arithmetic Operations

echo "--- PART 1: BASIC ARITHMETIC OPERATIONS ---\n";

// Task 1: Calculate average of three exam scores
function calculateAverage($score1, $score2, $score3) {
    return ($score1 + $score2 + $score3) / 3;
}

// Task 2: Calculate percentage based on total of 300 marks
function calculatePercentage($score1, $score2, $score3) {
    $totalMarks = $score1 + $score2 + $score3;
    return ($totalMarks / 300) * 100;
}

// Task 3: Check academic probation based on five subjects
function checkAcademicProbation($subjectMarks) {
    $failCount = 0;
    
    foreach ($subjectMarks as $subject => $mark) {
        if ($mark < 50) {
            $failCount++;
        }
    }
    
    if ($failCount > 2) {
        return "Student is placed on academic probation. ($failCount subjects failed)";
    } else {
        return "Student is not on academic probation. ($failCount subjects failed)";
    }
}

// Test Part 1
echo "Task 1 & 2: Average and Percentage Calculation\n";
echo "Enter exam 1 grade(0-100): ";
$exam1 = floatval(fgets(STDIN));
echo "Enter exam 2 grade(0-100): ";
$exam2 = floatval(fgets(STDIN));
echo "Enter exam 3 grade(0-100): ";
$exam3 = floatval(fgets(STDIN));

$average = calculateAverage($exam1, $exam2, $exam3);
$percentage = calculatePercentage($exam1, $exam2, $exam3);

echo "Exam Scores: $exam1, $exam2, $exam3\n";
echo "Average Score: " . number_format($average, 2) . "\n";
echo "Percentage: " . number_format($percentage, 2) . "%\n\n";

// Test academic probation
echo "Task 3: Academic Probation Check\n";
$subjects = [
    "Math" => 0,
    "Science" => 0,
    "English" => 0,
    "History" => 0,
    "Art" => 0
];

echo "Subject Marks:\n";
foreach ($subjects as $subject => $mark) {
    echo "- $subject: ";
    $subjects[$subject] = floatval(fgets(STDIN));
}
echo checkAcademicProbation($subjects) . "\n\n";

// Part 2: Conditional Logic and Loops

echo "--- PART 2: CONDITIONAL LOGIC AND LOOPS ---\n";

// Task 1: Pass/Fail determination
function determinePassFail($average) {
    if ($average >= 50) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Task 2: Honor Roll qualification
function checkHonorRoll($average, $exam1, $exam2, $exam3) {
    if ($average > 90 && ($exam1 > 95 || $exam2 > 95 || $exam3 > 95)) {
        return "QUALIFIES for Honor Roll";
    } else {
        return "Does not qualify for Honor Roll";
    }
}

// Task 3: Process grades for 5 students using a loop
echo "Task 3: Processing Grades for 5 Students\n";
echo "=========================================\n";

$students = [
    ["name" => "Alice Johnson", "exam1" => 88, "exam2" => 92, "exam3" => 96],
    ["name" => "Bob Smith", "exam1" => 45, "exam2" => 52, "exam3" => 48],
    ["name" => "Carol Davis", "exam1" => 92, "exam2" => 98, "exam3" => 94],
    ["name" => "David Wilson", "exam1" => 78, "exam2" => 85, "exam3" => 82],
    ["name" => "Eva Brown", "exam1" => 96, "exam2" => 94, "exam3" => 97]
];

foreach ($students as $index => $student) {
    echo "\nStudent " . ($index + 1) . ": " . $student['name'] . "\n";
    echo "Exam Scores: " . $student['exam1'] . ", " . $student['exam2'] . ", " . $student['exam3'] . "\n";
    
    $avg = calculateAverage($student['exam1'], $student['exam2'], $student['exam3']);
    $perc = calculatePercentage($student['exam1'], $student['exam2'], $student['exam3']);
    
    echo "Average: " . number_format($avg, 2) . "\n";
    echo "Percentage: " . number_format($perc, 2) . "%\n";
    echo "Result: " . determinePassFail($avg) . "\n";
    echo "Honor Roll: " . checkHonorRoll($avg, $student['exam1'], $student['exam2'], $student['exam3']) . "\n";
    
    // Grade classification
    if ($perc >= 90) {
        $grade = "A";
    } elseif ($perc >= 80) {
        $grade = "B";
    } elseif ($perc >= 70) {
        $grade = "C";
    } elseif ($perc >= 60) {
        $grade = "D";
    } else {
        $grade = "F";
    }
    echo "Grade: $grade\n";
    echo str_repeat("-", 40) . "\n";
}

// Additional: Interactive version (uncomment to use)

// echo "\n--- INTERACTIVE VERSION ---\n";
// echo "Enter student details:\n";

// $studentCount = 5;
// for ($i = 1; $i <= $studentCount; $i++) {
//     echo "\nStudent $i:\n";
//     echo "Enter name: ";
//     $name = trim(fgets(STDIN));
    
//     echo "Enter Exam 1 score: ";
//     $ex1 = (float)trim(fgets(STDIN));
    
//     echo "Enter Exam 2 score: ";
//     $ex2 = (float)trim(fgets(STDIN));
    
//     echo "Enter Exam 3 score: ";
//     $ex3 = (float)trim(fgets(STDIN));
    
//     $avg = calculateAverage($ex1, $ex2, $ex3);
//     $perc = calculatePercentage($ex1, $ex2, $ex3);
    
//     echo "\nResults for $name:\n";
//     echo "Average: " . number_format($avg, 2) . "\n";
//     echo "Percentage: " . number_format($perc, 2) . "%\n";
//     echo "Result: " . determinePassFail($avg) . "\n";
//     echo "Honor Roll: " . checkHonorRoll($avg, $ex1, $ex2, $ex3) . "\n";
//     // Grade classification
//     if ($perc >= 90) {
//         $grade = "A";
//     } elseif ($perc >= 80) {
//         $grade = "B";
//     } elseif ($perc >= 70) {
//         $grade = "C";
//     } elseif ($perc >= 60) {
//         $grade = "D";
//     } else {
//         $grade = "F";
//     }
//     echo "Grade: $grade\n";
//     echo str_repeat("-", 40) . "\n";
// }


echo "\n=== GRADING SYSTEM COMPLETE ===\n";
?>