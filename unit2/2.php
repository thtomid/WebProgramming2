<?php
/**
 * School Grading System - Interactive Version
 * Implements basic arithmetic operations, conditional logic, and loops
 */

echo "=== SCHOOL GRADING SYSTEM - INTERACTIVE VERSION ===\n\n";

// Function definitions
function calculateAverage($score1, $score2, $score3) {
    return ($score1 + $score2 + $score3) / 3;
}

function calculatePercentage($score1, $score2, $score3) {
    $totalMarks = $score1 + $score2 + $score3;
    return ($totalMarks / 300) * 100;
}

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

function determinePassFail($average) {
    if ($average >= 50) {
        return "Pass";
    } else {
        return "Fail";
    }
}

function checkHonorRoll($average, $exam1, $exam2, $exam3) {
    if ($average > 90 && ($exam1 > 95 || $exam2 > 95 || $exam3 > 95)) {
        return "QUALIFIES for Honor Roll 🎓";
    } else {
        return "Does not qualify for Honor Roll";
    }
}

function getGrade($percentage) {
    if ($percentage >= 90) {
        return "A";
    } elseif ($percentage >= 80) {
        return "B";
    } elseif ($percentage >= 70) {
        return "C";
    } elseif ($percentage >= 60) {
        return "D";
    } else {
        return "F";
    }
}

// Main interactive program
function main() {
    echo "Welcome to the School Grading System!\n";
    echo "This program will help you calculate and analyze student grades.\n\n";
    
    // Part 1: Three Exam Scores Analysis
    echo "--- PART 1: THREE EXAM SCORES ANALYSIS ---\n";
    
    // Get three exam scores
    $examScores = [];
    for ($i = 1; $i <= 3; $i++) {
        while (true) {
            echo "Enter Exam $i score (0-100): ";
            $input = trim(fgets(STDIN));
            $score = floatval($input);
            
            if ($score >= 0 && $score <= 100) {
                $examScores[] = $score;
                break;
            } else {
                echo "❌ Invalid input! Please enter a score between 0 and 100.\n";
            }
        }
    }
    
    // Calculate and display results for three exams
    $average = calculateAverage($examScores[0], $examScores[1], $examScores[2]);
    $percentage = calculatePercentage($examScores[0], $examScores[1], $examScores[2]);
    $passFail = determinePassFail($average);
    $honorRoll = checkHonorRoll($average, $examScores[0], $examScores[1], $examScores[2]);
    $grade = getGrade($percentage);
    
    echo "\n📊 RESULTS FOR THREE EXAMS:\n";
    echo "Exam Scores: " . implode(", ", $examScores) . "\n";
    echo "Average Score: " . number_format($average, 2) . "\n";
    echo "Percentage: " . number_format($percentage, 2) . "%\n";
    echo "Grade: $grade\n";
    echo "Status: $passFail\n";
    echo "Honor Roll: $honorRoll\n";
    
    // Part 2: Five Subjects Analysis
    echo "\n--- PART 2: FIVE SUBJECTS ANALYSIS ---\n";
    echo "Now let's analyze marks for 5 subjects to check for academic probation.\n";
    
    $subjects = ["Math", "Science", "English", "History", "Art"];
    $subjectMarks = [];
    
    foreach ($subjects as $subject) {
        while (true) {
            echo "Enter $subject marks (0-100): ";
            $input = trim(fgets(STDIN));
            $marks = floatval($input);
            
            if ($marks >= 0 && $marks <= 100) {
                $subjectMarks[$subject] = $marks;
                break;
            } else {
                echo "❌ Invalid input! Please enter marks between 0 and 100.\n";
            }
        }
    }
    
    // Display academic probation check
    $probationStatus = checkAcademicProbation($subjectMarks);
    echo "\n📚 SUBJECT MARKS ANALYSIS:\n";
    foreach ($subjectMarks as $subject => $mark) {
        $status = $mark >= 50 ? "✅ Pass" : "❌ Fail";
        echo "- $subject: $mark $status\n";
    }
    echo "Academic Status: $probationStatus\n";
    
    // Part 3: Multiple Students Processing
    echo "\n--- PART 3: MULTIPLE STUDENTS PROCESSING ---\n";
    
    while (true) {
        echo "How many students do you want to process? (1-10): ";
        $input = trim(fgets(STDIN));
        $studentCount = intval($input);
        
        if ($studentCount >= 1 && $studentCount <= 10) {
            break;
        } else {
            echo "❌ Please enter a number between 1 and 10.\n";
        }
    }
    
    $allStudents = [];
    
    for ($i = 1; $i <= $studentCount; $i++) {
        echo "\n--- Student $i Details ---\n";
        
        // Get student name
        echo "Enter student $i name: ";
        $name = trim(fgets(STDIN));
        
        // Get exam scores
        $studentScores = [];
        for ($j = 1; $j <= 3; $j++) {
            while (true) {
                echo "Enter Exam $j score for $name (0-100): ";
                $input = trim(fgets(STDIN));
                $score = floatval($input);
                
                if ($score >= 0 && $score <= 100) {
                    $studentScores[] = $score;
                    break;
                } else {
                    echo "❌ Invalid input! Please enter a score between 0 and 100.\n";
                }
            }
        }
        
        $allStudents[] = [
            'name' => $name,
            'scores' => $studentScores
        ];
    }
    
    // Display results for all students
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "FINAL RESULTS FOR ALL STUDENTS\n";
    echo str_repeat("=", 60) . "\n";
    
    foreach ($allStudents as $index => $student) {
        $name = $student['name'];
        $scores = $student['scores'];
        
        $avg = calculateAverage($scores[0], $scores[1], $scores[2]);
        $perc = calculatePercentage($scores[0], $scores[1], $scores[2]);
        $passFail = determinePassFail($avg);
        $honorRoll = checkHonorRoll($avg, $scores[0], $scores[1], $scores[2]);
        $grade = getGrade($perc);
        
        echo "\n🎓 Student " . ($index + 1) . ": $name\n";
        echo "   Exam Scores: " . implode(", ", $scores) . "\n";
        echo "   Average: " . number_format($avg, 2) . "\n";
        echo "   Percentage: " . number_format($perc, 2) . "%\n";
        echo "   Grade: $grade\n";
        echo "   Status: $passFail\n";
        echo "   Honor Roll: $honorRoll\n";
        
        // Add emojis for special achievements
        if (strpos($honorRoll, "QUALIFIES") !== false) {
            echo "   🎉 Congratulations! Outstanding performance!\n";
        }
        
        if ($passFail === "Fail") {
            echo "   💡 Recommendation: Consider additional support classes\n";
        }
        
        echo str_repeat("-", 50) . "\n";
    }
    
    // Summary Statistics
    echo "\n📈 SUMMARY STATISTICS:\n";
    $totalStudents = count($allStudents);
    $passCount = 0;
    $honorCount = 0;
    
    foreach ($allStudents as $student) {
        $scores = $student['scores'];
        $avg = calculateAverage($scores[0], $scores[1], $scores[2]);
        
        if ($avg >= 50) $passCount++;
        if ($avg > 90 && ($scores[0] > 95 || $scores[1] > 95 || $scores[2] > 95)) $honorCount++;
    }
    
    $passRate = ($passCount / $totalStudents) * 100;
    
    echo "Total Students Processed: $totalStudents\n";
    echo "Students Passed: $passCount\n";
    echo "Students on Honor Roll: $honorCount\n";
    echo "Overall Pass Rate: " . number_format($passRate, 2) . "%\n";
    
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "Thank you for using the School Grading System! 🎓\n";
    echo str_repeat("=", 60) . "\n";
}

// Run the main program
main();
?>