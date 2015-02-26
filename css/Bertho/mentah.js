if(nilai=='gender'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2_' + count + '" class="data2">'
					+ '<option value="man" selected >Man</option>'
					+ '<option value="woman">Woman</option>'
				+ '</select>'
			)
		}
		else if(nilai=='religion'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2_' + count + '" class="data2">'
					+ '<option value="protestan" selected >Protestan</option>'
					+ '<option value="khatolik">Khatolik</option>'
					+ '<option value="islam">Islam</option>'
					+ '<option value="budha">Budha</option>'
					+ '<option value="hindu">Hindu</option>'
				+ '</select>'
			)
		}
		else if(nilai=='blood'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2_' + count + '" class="data2">'
					+ '<option value="gol_a" selected >A</option>'
					+ '<option value="gol_b">B</option>'
					+ '<option value="gol_ab">AB</option>'
					+ '<option value="gol_o">O</option>'
				+ '</select>'
			)
		}
		else if(nilai=='birth_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='start_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='end_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='join_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='los_month'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Month Format" class="onlyMonth"/>'
			)
		}
		else{
			/*$this.closest("tr").find(".onlyDate").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" class="data2"/>'
			)*/
		}