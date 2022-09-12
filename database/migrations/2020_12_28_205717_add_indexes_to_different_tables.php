<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToDifferentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $instructors = $sm->listTableDetails('instructors');

            if (! $instructors->hasIndex('status')) {
                $table->index('status', 'status');
            }

            if (! $instructors->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }

            if (! $instructors->hasIndex('PricePerHour')) {
                $table->index('PricePerHour', 'PricePerHour');
            }

            if (! $instructors->hasIndex('specialty')) {
                $table->index('specialty', 'specialty');
            }

            if (! $instructors->hasIndex('video')) {
                $table->index('video', 'video');
            }

        });


        Schema::table('appointments', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $appointments = $sm->listTableDetails('appointments');

            if (! $appointments->hasIndex('status_id')) {
                $table->index('status_id', 'status_id');
            }

            if (! $appointments->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }

            if (! $appointments->hasIndex('instructor_id')) {
                $table->index('instructor_id', 'instructor_id');
            }

            if (! $appointments->hasIndex('start_time')) {
                $table->index('start_time', 'start_time');
            }

            if (! $appointments->hasIndex('accept')) {
                $table->index('accept', 'accept');
            }

            if (! $appointments->hasIndex('date')) {
                $table->index('date', 'date');
            }

            if (! $appointments->hasIndex('payment_transaction_id')) {
                $table->index('payment_transaction_id', 'payment_transaction_id');
            }
        });



        Schema::table('carts', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $carts = $sm->listTableDetails('carts');

            if (! $carts->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }

            if (! $carts->hasIndex('course_id')) {
                $table->index('course_id', 'course_id');
            }

            if (! $carts->hasIndex('student_package_id')) {
                $table->index('student_package_id', 'student_package_id');
            }

            if (! $carts->hasIndex('appointment_id')) {
                $table->index('appointment_id', 'appointment_id');
            }

            if (! $carts->hasIndex('category_id')) {
                $table->index('category_id', 'category_id');
            }

            if (! $carts->hasIndex('bundle_id')) {
                $table->index('bundle_id', 'bundle_id');
            }

            if (! $carts->hasIndex('type')) {
                $table->index('type', 'type');
            }
        });


        Schema::table('favourites', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $favourites = $sm->listTableDetails('favourites');

            if (! $favourites->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }

            if (! $favourites->hasIndex('instructor_id')) {
                $table->index('instructor_id', 'instructor_id');
            }

        });

        Schema::table('meetings', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $meetings = $sm->listTableDetails('meetings');

            if (! $meetings->hasIndex('meeting_id')) {
                $table->index('meeting_id', 'meeting_id');
            }

            if (! $meetings->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }
            if (! $meetings->hasIndex('owner_id')) {
                $table->index('owner_id', 'owner_id');
            }

            if (! $meetings->hasIndex('start_time')) {
                $table->index('start_time', 'start_time');
            }

        });


        Schema::table('time_zones', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $time_zones = $sm->listTableDetails('time_zones');

            if (! $time_zones->hasIndex('time_zone_name')) {
                $table->index('time_zone_name', 'time_zone_name');
            }

            if (! $time_zones->hasIndex('time')) {
                $table->index('time', 'time');
            }
            if (! $time_zones->hasIndex('status')) {
                $table->index('status', 'status');
            }

        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $payment_transactions = $sm->listTableDetails('payment_transactions');

            if (! $payment_transactions->hasIndex('transaction_ref')) {
                $table->index('transaction_ref', 'transaction_ref');
            }

            if (! $payment_transactions->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }
            if (! $payment_transactions->hasIndex('status')) {
                $table->index('status', 'status');
            }

            if (! $payment_transactions->hasIndex('payment_method')) {
                $table->index('payment_method', 'payment_method');
            }

            if (! $payment_transactions->hasIndex('vendor_transaction_id')) {
                $table->index('vendor_transaction_id', 'vendor_transaction_id');
            }


            if (! $payment_transactions->hasIndex('vendor_transaction_reference')) {
                $table->index('vendor_transaction_reference', 'vendor_transaction_reference');
            }

            if (! $payment_transactions->hasIndex('refund')) {
                $table->index('refund', 'refund');
            }

        });

        Schema::table('tutor_schedule_time_blocks', function (Blueprint $table) {


            $table->integer('zone')->nullable()->change();
            $table->integer('day')->nullable()->change();


            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $tutor_schedule_time_blocks = $sm->listTableDetails('tutor_schedule_time_blocks');

            if (! $tutor_schedule_time_blocks->hasIndex('zone')) {
                $table->index('zone', 'zone');
            }

            if (! $tutor_schedule_time_blocks->hasIndex('day')) {
                $table->index('day', 'day');
            }
            if (! $tutor_schedule_time_blocks->hasIndex('start_time')) {
                $table->index('start_time', 'start_time');
            }

            if (! $tutor_schedule_time_blocks->hasIndex('end_time')) {
                $table->index('end_time', 'end_time');
            }



        });


        Schema::table('tutor_time_off', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $tutor_time_off = $sm->listTableDetails('tutor_time_off');

            if (! $tutor_time_off->hasIndex('start_date')) {
                $table->index('start_date', 'start_date');
            }

            if (! $tutor_time_off->hasIndex('end_date')) {
                $table->index('end_date', 'end_date');
            }
            if (! $tutor_time_off->hasIndex('start_time')) {
                $table->index('start_time', 'start_time');
            }

            if (! $tutor_time_off->hasIndex('end_time')) {
                $table->index('end_time', 'end_time');
            }

            if (! $tutor_time_off->hasIndex('tutor_id')) {
                $table->index('tutor_id', 'tutor_id');
            }


        });

        Schema::table('user_language', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $user_language = $sm->listTableDetails('user_language');

            if (! $user_language->hasIndex('language_id')) {
                $table->index('language_id', 'language_id');
            }

            if (! $user_language->hasIndex('user_id')) {
                $table->index('user_id', 'user_id');
            }
            if (! $user_language->hasIndex('level_id')) {
                $table->index('level_id', 'level_id');
            }



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            //
        });
    }
}
